<?php

class AuthController extends BaseController {

    public function login()
    {
        try
        {
            // Set login credentials
            $credentials = [
                'email'    => Input::get('email'),
                'password' => Input::get('password')
            ];

            $validator = Validator::make($credentials,
                    [   'email' => 'required|email',
                        'password' => 'required'
                    ]
            );

            if ($validator->fails())
            {
                return Response::json(['flash' => $validator->messages()->first()], 500);
            }

            // Try to authenticate the user
            $user = Sentry::authenticate($credentials, Input::get('remember', false));

            return Response::json([], 200);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return Response::json(['flash' => 'Login field is required.'], 500);
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return Response::json(['flash' => 'Password field is required.'], 500);
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            return Response::json(['flash' => 'Wrong password, try again.'], 500);
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Response::json(['flash' => 'User was not found.'], 500);
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            return Response::json(['flash' => 'User is not activated.'], 500);
        }

        // The following is only required if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            return Response::json(['flash' => 'User is suspended.'], 500);
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            return Response::json(['flash' => 'User is banned.'], 500);
        }
    }

    public function logout()
    {
        Sentry::logout();

        return Redirect::to('/');
    }

    public function register()
    {
        $credentials = [
            'email'    => Input::get('email'),
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'activated' => true,
        ];

        $validator = Validator::make($credentials,
                [   'email' => 'required|email|unique:users',
                    'username' => 'required|unique:users',
                    'password' => 'required'
                ]
        );

        if ($validator->fails())
        {
            return Response::json(['flash' => $validator->messages()->first()], 500);
        }

        try
        {

            $user = Sentry::createUser($credentials);

            Sentry::login($user, true);

            $data = ['user' => $user];

            Mail::send('emails.welcome', $data, function($message) use($user)
            {
                $message->to($user->email, $user->username)->subject('Welcome on Gruik !');
            });

            return Response::json([], 200);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return Response::json(['flash' => 'Email is required..'], 500);
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return Response::json(['flash' => 'Password field is required..'], 500);
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return Response::json(['flash' => 'User with this login already exists..'], 500);
        }
    }

    public function forgotPassword()
    {
        $email = Input::get('email', false);
        if ( $email )
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                try {

                    $user = Sentry::findUserByLogin( $email );

                    Mail::send('emails.auth.reminder', [
                        'token'  => $user->getResetPasswordCode()
                    ], function ($message) use ($user)
                    {
                        $message->to($user->email, $user->username)->subject('Password reset request !');
                    });

                    return Response::json([], 200);
                } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    return Response::json(['flash' => 'No user has been found with this email'], 400);
                }



            } else {
                return Response::json(['flash' => 'A valid email must be provided'], 400);
            }
        }

        return Response::json(['flash' => 'Email field is required'], 400);
    }

    public function resetPassword()
    {
        $token                 = Input::get('token', false);

        $password              = Input::get('password', false);
        $password_confirmation = Input::get('password_confirmation', false);

        if ( $token and $password and $password_confirmation )
        {
            if ( $password === $password_confirmation )
            {
                try {

                    $user = Sentry::findUserByResetPasswordCode($token);

                    if ($user->checkResetPasswordCode($token))
                    {
                        // Attempt to reset the user password
                        if ($user->attemptResetPassword($token, $password))
                        {
                            return Response::json([], 200);
                        }
                        else
                        {
                            return Response::json(['flash' => 'Password reset fail'], 400);
                        }
                    }
                }catch(Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                    return Response::json(['flash' => 'No user has been found'], 400);
                }
            } else {
                return Response::json(['flash' => 'Password and password confirmation must be the same'], 400);
            }
        }
        return Response::json(['flash' => 'Field missing'], 400);
    }
}
