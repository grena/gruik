<?php

namespace Gruik\Service;

use \App;

class SearchService {

    public function searchPostsOwnerQuery($userId, $term, $page = 1)
    {
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');

        return $postRepo->searchByTermQuery($term)
            ->where('user_id', $userId);
    }

    public function searchPostsPublicQuery($term, $page = 1, $userToExclude = null)
    {
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');

        $query = $postRepo->searchByTermQuery($term)
            ->where('private', false);

        if ($userToExclude) {
            $query->where('user_id', '!=', $userToExclude);
        }

        return $query;
    }

    public function searchUsersQuery($term, $page = 1)
    {
        $userRepo = App::make('Gruik\Repo\User\UserInterface');

        return $userRepo->byPartialUsernameQuery($term)->select(['username', 'email', 'users.created_at']);
    }
}
