<?php

class SettingsController extends BaseController {

    public function view()
    {
        JavaScript::put([
            'user' => Sentry::getUser()
        ]);

        return View::make('auth.settings')
                    ->with('user', Sentry::getUser());
    }

}
