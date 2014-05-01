<?php

class SettingsController extends BaseController {

    public function view()
    {
        $userRepo = App::make('Gruik\Repo\User\UserInterface');

        $user = Sentry::getUser();
        $user->preferences = $userRepo->getPreferencesForUser($user->id);

        JavaScript::put([
            'user' => $user
        ]);

        return View::make('auth.settings')
                    ->with('user', $user);
    }

}
