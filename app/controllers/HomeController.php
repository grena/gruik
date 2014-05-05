<?php

class HomeController extends BaseController {

	public function home()
	{
        if(Sentry::check())
        {
            return Redirect::to('dashboard');
        }
        else
        {
    		return View::make('front.home');
        }
	}

    public function explore()
    {
        return View::make('front.explore')
                    ->with('user', Sentry::getUser());
    }

    public function login()
    {
        return View::make('front.login');
    }

    public function register()
    {
        return View::make('front.register');
    }

	public function forgotPassword()
	{
		return View::make('front.forgot');
	}

	public function passwordReset( $token )
	{

		if ( $token )
		{

			return View::make('front.resetPassword')->withToken( $token );
		}

		App::abort(404);
	}

}
