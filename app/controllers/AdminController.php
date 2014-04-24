<?php

class AdminController extends BaseController {

    public function dashboard()
    {
        return View::make('admin.dashboard')
                    ->with('user', Sentry::getUser());
    }
}