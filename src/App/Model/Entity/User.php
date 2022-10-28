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

    public function __construct(string $lastname, string $firstname, string $email, string $password, UserRole $role)
    {
        $this->id = 0;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
}
