<?php

namespace App\Controller\Form;

use Prout\Form;

class LoginForm extends Form
{
    public string $email;
    public string $password;

    public function __construct()
    {
        $this->email = $_POST['email'] ?? '';
        $this->password = $_POST['password'] ?? '';
    }

    public function isValid()
    {
        return !empty($this->email) && !empty($this->password);
    }
}
