<?php

namespace App\Model\Repository;

use App\Model\Entity\User;
use Prout\Database;

class UserRepository
{

    public static function truncate() {
        $query = 'TRUNCATE TABLE user;';
        Database::get()->query($query);
    }

    public static function save(User $user) {
        $query = 'INSERT 
        INTO user(lastname, firstname, email, password, role)
        VALUES (:lastname, :firstname, :email, :password, :role);';
        $statement = Database::get()->prepare($query);
        $statement->execute([
            'lastname' => $user->lastname,
            'firstname' => $user->firstname,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role,
        ]);
    }
}
