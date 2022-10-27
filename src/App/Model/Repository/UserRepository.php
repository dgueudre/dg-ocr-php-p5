<?php

namespace App\Model\Repository;

use App\Model\Entity\User;
use App\Model\Enum\UserRole;
use Prout\Database;
use Prout\SQL;

class UserRepository
{
    public static function truncate()
    {
        $query = 'SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE TABLE user;
        SET FOREIGN_KEY_CHECKS = 1;';
        Database::execute($query);
    }

    public static function create()
    {
        $query = 'CREATE TABLE user (
            id INT AUTO_INCREMENT,
            lastname VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            role '.SQL::enum(UserRole::class).' NOT NULL,
            PRIMARY KEY (id)
        );';
        Database::execute($query);
    }

    public static function save(User $user): User
    {
        $query = 'INSERT 
        INTO user(lastname, firstname, email, password, role)
        VALUES (:lastname, :firstname, :email, :password, :role);';

        $user->id = Database::insert($query, [
            'lastname' => $user->lastname,
            'firstname' => $user->firstname,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role->name,
        ]);

        return $user;
    }

    public static function findOneById($id)
    {
        $query = 'SELECT * 
            FROM user
            WHERE id = :id;';

        return Database::fetch($query, [
            'id' => $id,
        ], User::class);
    }

    public static function findOneByEmail($email)
    {
        $query = 'SELECT * 
            FROM user
            WHERE email = :email;';

        return Database::fetch($query, [
            'email' => $email,
        ], User::class);
    }
}
