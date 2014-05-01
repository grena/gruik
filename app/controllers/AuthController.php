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
}