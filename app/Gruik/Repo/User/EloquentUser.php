<?php namespace Gruik\Repo\User;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;

use \User;
use \UserPreference;

class EloquentUser extends RepoAbstract implements RepoInterface, UserInterface {

    protected $userPreference;

    public function __construct(User $user, UserPreference $userPreference)
    {
        $this->model = $user;
        $this->userPreference = $userPreference;
    }

    public function byId($id)
    {
        return \Sentry::findUserById($id);
    }

    public function getPreferencesForUser($id)
    {
        $user_preferences = $this->userPreference->where('user_id', $id)->get();
        $config = \Config::get('user_preferences');

        $preferences = [
            'posts.private',
            'posts.allow_comments'
        ];

        $send = [];

        foreach($preferences as $key)
        {
            $user_pref = array_first($user_preferences, function($k, $v) use($key) {
                return $v->key == $key;
            }, null);

            $value = $user_pref ? $user_pref->value :  array_get($config, $key);

            $send[$key] = $value;
        }

        return $send;
    }

    public function setPreferencesForUser($id, $data)
    {
        $config = \Config::get('user_preferences');

        $preferences = [
            'posts.private',
            'posts.allow_comments'
        ];

        \DB::table('user_preferences')->where('user_id', $id)->delete();
        $inserts = [];

        foreach($preferences as $key)
        {
            $value = array_get($data, $key, array_get($config, $key));
            $inserts[] = ['key' => $key, 'value' => $value, 'user_id' => $id];
        }

        \DB::table('user_preferences')->insert($inserts);
    }
}