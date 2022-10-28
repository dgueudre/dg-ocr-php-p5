<?php

namespace App\Controller;

use App\Model\Repository\UserRepository;
use Prout\Form;
use Prout\Template;

class AuthController
{
    public function login()
    {
        if (!Form::validate(['email', 'password'])) {
            return Template::render('auth.login');
        }

        $user = UserRepository::findOneByCredentials($_POST['email'], $_POST['password']);

        var_dump($user);
    }

    public function register()
    {
        return 'actionRegister';
    }
}
