<?php

class TagController extends BaseController {

    public function all()
    {
        return View::make('admin.tags')
                    ->with('user', Sentry::getUser());
    }

}
