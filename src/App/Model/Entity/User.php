<?php

namespace App\Model\Entity;

use App\Model\Enum\UserRole;
use Prout\Entity;

class User extends Entity
{
    public int $id;
    public string $lastname;
    public string $firstname;
    public string $email;
    public string $password;
    private string $role;

    public static function fromSQL($id, $lastname, $firstname, $email, $password, $role): static
    {
        $new = new static();
        $new->id = $id;
        $new->lastname = $lastname;
        $new->firstname = $firstname;
        $new->email = $email;
        $new->password = $password;
        $new->role = $role;

        return $new;
    }

    // public function __construct($id, $lastname, $firstname, $email, $password, $role)
    // {
    //     $this->id = $id;
    //     $this->lastname = $lastname;
    //     $this->firstname = $firstname;
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->setRole($role);
    // }

    public function setRole(UserRole $role)
    {
        $this->role = $role->name;
    }

    public function getRole(): UserRole
    {
        return UserRole::from($this->role);
    }

    public function getSqlRole(): string
    {
        return $this->role;
    }
}
