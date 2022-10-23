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
    public string $role;

    // public function __construct($id, $lastname, $firstname, $email, $password, $role)
    // {
    //     $this->id = $id;
    //     $this->lastname = $lastname;
    //     $this->firstname = $firstname;
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->setRole($role);
    // }

    public function __set($name, $value)
    {
        var_dump('test');
        $method = 'set'.ucfirst($name);
        if (method_exists($this, $method)) {
            $this->$method($value);
            return ;
        }
        $this->$name = $value;
    }

    public function setRole(UserRole|string $role)
    {
        if (gettype($role) === 'string') {
            UserRole::cases($role);
            $this->role = $role;
        } else {
            $this->role = $role->name;
        }
    }
}
