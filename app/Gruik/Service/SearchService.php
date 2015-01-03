<?php

namespace Gruik\Service;

use \App;

class SearchService {

    public function searchPostsOwnerQuery($userId, $term, $sortBy = null)
    {
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');

        $query = $postRepo->searchByTermQuery($term)
            ->where('user_id', $userId);

        $sortOptions = $this->_extractSortOptions($sortBy, ['created_at', 'updated_at']);

        if ($sortOptions) {
            $query->orderBy($sortOptions['field'], $sortOptions['order']);
        }

        return $query;
    }

    public function searchPostsPublicQuery($userToExclude = null, $term = '', $sortBy = null)
    {
        $postRepo = App::make('Gruik\Repo\Post\PostInterface');

        $query = $postRepo->searchByTermQuery($term)
            ->where('private', false);

        if ($userToExclude) {
            $query->where('user_id', '!=', $userToExclude);
        }

        $sortOptions = $this->_extractSortOptions($sortBy, ['created_at', 'updated_at']);

        if ($sortOptions) {
            $query->orderBy($sortOptions['field'], $sortOptions['order']);
        }

        return $query;
    }

    public function searchUsersQuery($term, $sortBy = null)
    {
        $userRepo = App::make('Gruik\Repo\User\UserInterface');

        $query = $userRepo->byPartialUsernameQuery($term)->select(['username', 'email', 'users.created_at']);
        $sortOptions = $this->_extractSortOptions($sortBy, ['created_at']);

        if ($sortOptions) {
            $query->orderBy($sortOptions['field'], $sortOptions['order']);
        }

        return $query;
    }

    /**
     * Extracts SQL "SortBy" $options available in $acceptedFields to return
     * a correct array of parameters.
     *
     * @param  string $options        Options to split and extract
     * @param  array  $acceptedFields Accepted fields to be filtered
     *
     * @return mixed                  Array of "field" and "order" if correct, null if not
     */
    private function _extractSortOptions($options = '', $acceptedFields = [])
    {
        $options = trim($options);

        if (empty($options)) {
            return null;
        }

        if (substr_count($options, ',') !== 1) {
            return null;
        }

        $options = explode(',', $options);
        $field = trim($options[0]);
        $order = trim($options[1]);

        if (in_array($field, $acceptedFields) && in_array($order, ['asc', 'desc'])) {
            return ['field' => $field, 'order' => $order];
        } else {
            return null;
        }
    }
}
