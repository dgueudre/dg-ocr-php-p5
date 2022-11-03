<?php

namespace App\Controller;

use App\Controller\Form\CommentForm;
use App\Model\Entity\Comment;
use App\Model\Entity\User;
use App\Model\Repository\CommentRepository;
use Prout\Alert;

class CommentController
{
    public function create($id)
    {
        /** @var User $user */
        $user = $_SESSION['user'] ?? false;

        if (!$user) {
            array_push($_SESSION['alerts'], new Alert('Vous devez être connecté pour ajouter un commentaire'));
            header('location: /posts/'.$id);

            return;
        }

        $form = new CommentForm();

        if (!$form->isValid()) {
            array_push($_SESSION['alerts'], new Alert('Saisie incorrecte'));
            header('location: /posts/'.$id);

            return;
        }

        $comment = Comment::create($form->comment, $id, $user->id);

        $comment = CommentRepository::save($comment);
        header('location: /posts/'.$id);
    }
}
