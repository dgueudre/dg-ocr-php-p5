<?php

namespace App\Controller;

use App\Controller\Form\PostForm;
use App\Model\Entity\Post;
use App\Model\Entity\User;
use App\Model\Enum\UserRole;
use App\Model\Repository\PostRepository;
use App\Model\Repository\UserRepository;
use Prout\Alert;
use Prout\Template;

class PostController
{
    public function list()
    {
        $posts = PostRepository::findAll();

        return Template::render('post.list', [
            'posts' => $posts,
        ]);
    }

    public function view($params)
    {
        $post = PostRepository::findOneById($params['id']);
        $author = UserRepository::findOneById($post->author_id);

        return Template::render('post.view', [
            'post' => $post,
            'author' => $author,
        ]);
    }

    public function edit($params)
    {
        $id = $params['id'];
        /** @var User $user */
        $user = $_SESSION['user'] ?? false;

        if (!$user) {
            array_push($_SESSION['alerts'], new Alert('Vous devez être connecté pour modifier un post'));
            header(strtr('location: /posts/{id}', ['{id}' => $id]));

            return;
        }

        if (UserRole::ADMIN !== $user->role) {
            array_push($_SESSION['alerts'], new Alert('Vous n avez pas les droits de modifier un post'));
            header(strtr('location: /posts/{id}', ['{id}' => $id]));

            return;
        }

        $post = PostRepository::findOneById($id);

        if (!$post) {
            array_push($_SESSION['alerts'], new Alert('Post introuvable'));
            header('location: /posts');

            return;
        }

        $form = new PostForm($post);

        if (!$form->isSubmitted()) {
            return Template::render('post.form', ['mode' => 'edit', 'form' => $form, 'post' => $post]);
        }
        if (!$form->isValid()) {
            array_push($_SESSION['alerts'], new Alert('Saisie incorrecte'));

            return Template::render('post.form', ['mode' => 'edit', 'form' => $form, 'post' => $post]);
        }

        $post->modify($form->title, $form->intro, $form->content);

        // $post = new Post($form->title, $form->intro, $form->content, $user->id);

        $post = PostRepository::save($post);
        header(strtr('location: /posts/{id}', ['{id}' => $post->id]));
    }
}
