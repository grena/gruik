<?php

class PostController extends BaseController {

    public function edit()
    {
        $tagRepo = \App::make('Gruik\Repo\Tag\TagInterface');
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');

        $id_edit = Input::get('edit', false);

        if($id_edit)
        {
            $post = $postRepo->byId($id_edit)->toArray();
            $tags = $tagRepo->byPostId($id_edit)->toArray();

            $tags_string = array_map(function($tag) {
                return $tag['label'];
            }, $tags);

            // Boo-boo-boolean
            $post['private'] = $post['private'] == "1" ? true : false;
            $post['allow_comments'] = $post['allow_comments'] == "1" ? true : false;

            JavaScript::put([
                'edited_post' => $post,
                'edited_tags' => $tags_string
            ]);
        }

        $tags = $tagRepo->byUserId(Sentry::getUser()->id)->toArray();

        $tags_string = array_map(function($tag) {
            return ['label' => $tag['label']];
        }, $tags);

        JavaScript::put([
            'tags' => $tags_string
        ]);

        return View::make('admin.dashboard')
                    ->with('user', Sentry::getUser())
                    ->with('tags', $tags);
    }

    public function all()
    {
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');

        $limit = Input::get('limit', 20);

        $total = $postRepo->byUserId(Sentry::getUser()->id)->count();

        $posts = $postRepo->byUserIdQuery(Sentry::getUser()->id)
                    ->with('tags')
                    ->paginate($limit);

        JavaScript::put([
            'posts' => $posts->toArray()
        ]);

        return View::make('admin.posts')
                    ->with('user', Sentry::getUser())
                    ->with('limit', $limit)
                    ->with('posts', $posts);
    }

}
