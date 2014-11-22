<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = Sentry::createUser(array(
            'email'     => 'test@example.com',
            'username'  => 'test',
            'password'  => 'test',
            'activated' => true,
        ));
    }
}