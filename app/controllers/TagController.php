<?php

class TagController extends BaseController {

    public function alist()
    {
        return View::make('admin.tags')
                    ->with('user', Sentry::getUser());
    }

}
