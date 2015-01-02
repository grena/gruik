<?php

use Carbon\Carbon;
use \App;
use \Gruik\Service\SearchService;
use Illuminate\Pagination\Paginator;
use \Gravatar;

class SearchController extends BaseController {

    public function search()
    {
        $currentUser = Sentry::getUser();
        $userId = $currentUser ? $currentUser->id : null;
        $searchService = new SearchService;

        $term = trim(Input::get('q'));
        $type = Input::get('type', 'owner');
        $page = Input::get('p', 1);

        if (! $term) {
            return View::make('front.search')
                        ->with('user', Sentry::getUser());
        }

        if( ! $currentUser && $type == 'owner') {
            return Redirect::route('search', [
                'q' => Input::get('q'),
                'p' => Input::get('p'),
                'type' => 'public'
            ]);
        }

        $countOwnerPosts = $searchService->searchPostsOwnerQuery($userId, $term, $page)
            ->count();

        $countPublicPosts = $searchService->searchPostsPublicQuery($term, $page, $userId)
            ->count();

        $countUsers = $searchService->searchUsersQuery($term, $page)
            ->count();

        switch ($type) {
            case 'public':

                $result = $searchService->searchPostsPublicQuery($term, $page, $userId)
                    ->paginate(15);

                break;
            case 'users':

                $result = $searchService->searchUsersQuery($term, $page)
                    ->leftJoin('posts', 'posts.user_id', '=', 'users.id')
                    ->addSelect(DB::raw('COUNT(posts.id) as public_posts'))
                    ->groupBy('users.id')
                    ->paginate(15);

                $result->getCollection()->map(function($user) {
                    $user->avatar = Gravatar::src( $user->email, 45 );
                    $diff = Carbon::now()->diffInMinutes(Carbon::parse($user->created_at));
                    $user->created_at = Carbon::now()->subMinutes($diff)->diffForHumans();

                    unset($user->email);
                });

                break;
            case 'owner':
            default:

                $result = $searchService->searchPostsOwnerQuery($userId, $term, $page)
                    ->paginate(15);

                break;
        }

        if ($type == 'public' || $type == 'owner') {
            $result->getCollection()->map(function($post) {
                $diff = Carbon::now()->diffInMinutes(Carbon::parse($post->created_at));
                $post->created_at_human = Carbon::now()->subMinutes($diff)->diffForHumans();
            });
        }

        JavaScript::put([
            'result' => $result->toArray()
        ]);

        return View::make('front.search')
                    ->with('user', Sentry::getUser())
                    ->with('countOwnerPosts', $countOwnerPosts)
                    ->with('countPublicPosts', $countPublicPosts)
                    ->with('countUsers', $countUsers)
                    ->with('result', $result);
    }

}
