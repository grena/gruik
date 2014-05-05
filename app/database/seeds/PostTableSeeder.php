<?php

class PostTableSeeder extends Seeder
{
    public function run()
    {
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');

        $post1 = [
            'user_id' => 1,
            'title' => 'My hello world',
            'md_content' => '#Hello world !',
            'private' => false,
            'allow_comments' => true,
        ];

        $post2 = [
            'user_id' => 1,
            'title' => 'My private note.',
            'md_content' => 'Because markdown is __awesome__.',
            'private' => true,
            'allow_comments' => false,
        ];

        $postRepo->store($post1);
        $postRepo->store($post2);
    }
}