<?php

namespace App\Model\Fixture;

use App\Model\Entity\User;
use App\Model\Repository\UserRepository;

class UserFixture
{
    public static function run()
    {
        UserRepository::truncate();

        // https://randomuser.me/
        $user = new User();
        $user->lastname = "Wilson";
        $user->firstname = "Toni";
        $user->email = "toni.wilson@example.com";
        $user->password = "skirt";
        $user->role = "ADMIN";
        UserRepository::save($user);

        $user = new User();
        $user->lastname = "Chapman";
        $user->firstname = "Mathew";
        $user->email = "mathew.chapman@example.com";
        $user->password = "trucks";
        $user->role = "USER";
        UserRepository::save($user);
    }
}
