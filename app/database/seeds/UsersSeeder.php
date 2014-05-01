<?php

class UsersSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->email = "foo@bar.com";
        $user->display_name = "ADMIN";
        $user->password = Hash::make('admin');
        $user->save();
    }
}