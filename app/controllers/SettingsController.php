<?php

class SettingsController extends BaseController {

    public function view()
    {
        return View::make('admin.settings')
                    ->with('user', Sentry::getUser());
    }

}
