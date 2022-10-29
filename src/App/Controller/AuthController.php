<?php

namespace App\Controller;

use App\Controller\Form\LoginForm;
use App\Controller\Form\RegisterForm;
use App\Model\Entity\User;
use App\Model\Enum\UserRole;
use App\Model\Repository\UserRepository;
use Prout\Alert;
use Prout\Template;

class AuthController
{
    public function login()
    {
        $form = new LoginForm();

        if (!$form->isSubmitted()) {
            return Template::render('auth.login', ['form' => $form]);
        }
        if (!$form->isValid()) {
            array_push($_SESSION['alerts'], new Alert('Vous devez remplir tous les champs'));

            return Template::render('auth.login', ['form' => $form]);
        }

        $user = UserRepository::findOneByCredentials($form->email, $form->password);

        if (!$user) {
            array_push($_SESSION['alerts'], new Alert('Identifiants incorrects'));

            return Template::render('auth.login', ['form' => $form]);
        }

        $_SESSION['user'] = $user;
        header('location: /');
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
        $form = new RegisterForm();

        if (!$form->isSubmitted()) {
            return Template::render('auth.register', ['form' => $form]);
        }
        if (!$form->isValid()) {
            array_push($_SESSION['alerts'], new Alert('Saisie incorrecte'));

            return Template::render('auth.register', ['form' => $form]);
        }

        $exists = UserRepository::findOneByEmail($form->email);

        if ($exists) {
            array_push($_SESSION['alerts'], new Alert('L email est déjà utilisé'));

            return Template::render('auth.register', ['form' => $form]);
        }

        $user = new User($form->lastname, $form->firstname, $form->email, $form->password, UserRole::USER);

        UserRepository::save($user);

        $_SESSION['user'] = $user;
        header('location: /');
    }
}
