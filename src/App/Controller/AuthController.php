<?php

namespace App\Controller;

use App\Model\Repository\UserRepository;
use Prout\Form;
use Prout\Template;

class AuthController
{
    public function login()
    {
        if(!Form::validate(['email', 'password'])) {
            return Template::render('auth.login');
        }

        $user = UserRepository::findOneByEmail($_POST['email']);

        var_dump($user);
        
    }

    public function register()
    {
        return 'actionRegister';
    }
}
