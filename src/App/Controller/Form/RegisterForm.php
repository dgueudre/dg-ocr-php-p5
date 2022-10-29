<?php

namespace App\Controller\Form;

use Prout\Form;

class RegisterForm extends Form
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $confirm;

    public function __construct()
    {
        $this->firstname = $_POST['firstname'] ?? '';
        $this->lastname = $_POST['lastname'] ?? '';
        $this->email = $_POST['email'] ?? '';
        $this->password = $_POST['password'] ?? '';
        $this->confirm = $_POST['confirm'] ?? '';
    }

    public function isValid()
    {
        return
            !empty($this->firstname)
            && !empty($this->lastname)
            && !empty($this->email)
            && !empty($this->password)
            && !empty($this->confirm)
            && $this->password === $this->confirm;
    }
}
