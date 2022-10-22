<?php

namespace App\Model\Repository;

use App\Model\Entity\User;
use Prout\Database;

class UserRepository
{
    public static function truncate()
    {
        $query = 'TRUNCATE TABLE user;';
        Database::get()->query($query);
    }

    public static function create()
    {
        $query = 'CREATE TABLE user (
            id INT AUTO_INCREMENT,
            lastname VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            role VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        );';
        Database::get()->query($query);
    }

    public static function save(User $user)
    {
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

    public static function findOneByEmail($email)
    {
        $query = 'SELECT * 
            FROM user
            WHERE email = :email;';
        $statement = Database::get()->prepare($query);
        $statement->execute([
            'email' => $email,
        ]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, User::class);

        return $statement->fetch();
    }
}
