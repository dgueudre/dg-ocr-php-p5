<?php

namespace App\Model\Entity;

use App\Model\Enum\UserRole;

class User
{
    public int $id;
    public string $lastname;
    public string $firstname;
    public string $email;
    public string $password;
    public UserRole $role;
}
