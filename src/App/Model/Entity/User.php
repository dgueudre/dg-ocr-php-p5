<?php

namespace App\Model\Entity;

use App\Model\Enum\UserRole;
use Prout\Entity;

class User extends Entity
{
    public int $id;
    public readonly string $lastname;
    public readonly string $firstname;
    public readonly string $email;
    public readonly string $password;
    public readonly UserRole $role;

    public function __construct($params = null)
    {
        $this->id = 0;
        if ($params) {
            extract($params);
            $this->lastname = $lastname;
            $this->firstname = $firstname;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }
    }

    public static function create(string $lastname, string $firstname, string $email, string $password, UserRole $role): User
    {
        return new User(compact('lastname', 'firstname', 'email', 'password', 'role'));
    }

    protected function sqlset_role(string $role)
    {
        $this->role = UserRole::from($role);
    }
}
