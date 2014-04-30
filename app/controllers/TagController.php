<?php

class TagController extends BaseController {

    public function all()
    {
        return View::make('auth.tags')
                    ->with('user', Sentry::getUser());
    }

}
