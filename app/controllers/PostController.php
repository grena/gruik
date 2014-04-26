<?php

class PostController extends BaseController {

    public function all()
    {
        return View::make('admin.posts')
                    ->with('user', Sentry::getUser());
    }

}
