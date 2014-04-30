<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = Sentry::createUser(array(
            'email'     => 'test@grena.fr',
            'username'  => 'test',
            'password'  => 'test',
            'activated' => true,
        ));
    }
}