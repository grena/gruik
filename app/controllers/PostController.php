<?php

class PostController extends BaseController {

    public function alist()
    {
        return View::make('admin.posts')
                    ->with('user', Sentry::getUser());
    }

}
