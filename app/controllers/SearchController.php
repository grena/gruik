<?php

use Carbon\Carbon;
use \Gruik\Service\SearchService;
use Illuminate\Pagination\Paginator;

class SearchController extends BaseController {

    public function search()
    {
        $currentUser = Sentry::getUser();
        $userId = $currentUser ? $currentUser->id : null;
        $searchService = new SearchService;

        $term = trim(Input::get('q', ''));
        $type = Input::get('type', 'owner');
        $sortBy = Input::get('s', 'created_at,desc');

        if (! $term) {
            return View::make('front.search')
                ->with('term', $term)
                ->with('user', Sentry::getUser());
        }

        if( ! $currentUser && $type == 'owner') {
            return Redirect::route('search', [
                'q' => Input::get('q'),
                'type' => 'public'
            ]);
        }

        $countOwnerPosts = $searchService->searchPostsOwnerQuery($userId, $term)
            ->count();

        $countPublicPosts = $searchService->searchPostsPublicQuery($userId, $term)
            ->count();


        $countUsers = $searchService->searchUsersQuery($term)
            ->count();

        switch ($type) {
            case 'public':

                $result = $searchService->searchPostsPublicQuery($userId, $term, $sortBy)
                    ->paginate(15);

                break;
            case 'users':

                $result = $searchService->searchUsersQuery($term, $sortBy)
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
                $result = $searchService->searchPostsOwnerQuery($userId, $term, $sortBy)
                    ->paginate(15);

                break;
            default:
                return Redirect::route('search',[
                    'q' => Input::get('q'),
                    'type' => 'owner',
                    'term' => $term
                ]);

                break;
        }

        if ($type == 'public' || $type == 'owner') {
            $result->getCollection()->map(function($post) {
                $diff = Carbon::now()->diffInMinutes(Carbon::parse($post->created_at));
                $post->created_at_human = Carbon::now()->subMinutes($diff)->diffForHumans();
            });
        }

        JavaScript::put([
            'result' => $result->toArray(),
            'sortBy' => $sortBy
        ]);

        $pagination = $result->appends([
            'q' => Input::get('q'),
            'type' => Input::get('type'),
            's' => Input::get('s'),
            'o' => Input::get('o')
        ])
        ->links();

        return View::make('front.search')
            ->with('term', $term)
            ->with('user', Sentry::getUser())
            ->with('countOwnerPosts', $countOwnerPosts)
            ->with('countPublicPosts', $countPublicPosts)
            ->with('countUsers', $countUsers)
            ->with('pagination', $pagination)
            ->with('result', $result);
    }

}
