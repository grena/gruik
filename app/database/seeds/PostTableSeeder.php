<?php

class PostTableSeeder extends Seeder
{
    public function run()
    {
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');

        $post1 = [
            'user_id' => 1,
            'title' => 'My hellow world',
            'md_content' => '#Hello world !',
            'html_content' => '<h1>Hello world !</h1>',
            'private' => false,
            'allow_comments' => true,
        ];

        $post2 = [
            'user_id' => 1,
            'title' => 'The MARKDOWN.',
            'md_content' => 'Because markdown is __awesome__.',
            'html_content' => '<p>Because markdown is <strong>awesome</strong>.</p>',
            'private' => true,
            'allow_comments' => false,
        ];

        $postRepo->store($post1);
        $postRepo->store($post2);
    }
}