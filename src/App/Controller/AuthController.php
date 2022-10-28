<?php

namespace App\Controller;

use App\Model\Repository\UserRepository;
use Prout\Alert;
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

        if (!$user) {
            $_SESSION['alerts'] = $_SESSION['alerts'] ?? [];
            array_push($_SESSION['alerts'], new Alert('Identifiants incorrects'));
            header('location: /login');
        } else {
            $_SESSION['user'] = $user;
            header('location: /');
        }
    }

    public function logout()
    {
        if ($_SESSION['user'] ?? false) {
            unset($_SESSION['user']);
        }
        header('location: /');
    }

    public function register()
    {
        return 'actionRegister';
    }
}
