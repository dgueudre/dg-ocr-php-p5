<?php

namespace App\Controller;

use App\Controller\Form\PostForm;
use App\Model\Entity\Post;
use App\Model\Entity\User;
use App\Model\Enum\UserRole;
use App\Model\Repository\CommentRepository;
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

    public function view(int $id)
    {
        $post = PostRepository::findOneById($id);
        $author = UserRepository::findOneById($post->author_id);
        $comments = CommentRepository::findAllByPostId($post->id);

        return Template::render('post.view', compact('post', 'author', 'comments'));
    }

    private function form($mode, $label_action, $back_url, $id = 0)
    {
        /** @var User $user */
        $user = $_SESSION['user'] ?? false;

        if (!$user) {
            array_push($_SESSION['alerts'], new Alert("Vous devez être connecté pour $label_action un post"));
            header('location: '.$back_url);

            return;
        }

        if (UserRole::ADMIN !== $user->role) {
            array_push($_SESSION['alerts'], new Alert("Vous n'avez pas les droits de $label_action un post"));
            header('location: '.$back_url);

            return;
        }

        if ('create' === $mode) {
            $post = null;
        } else {
            $post = PostRepository::findOneById($id);

            if (!$post) {
                array_push($_SESSION['alerts'], new Alert('Post introuvable'));
                header('location: /posts');

                return;
            }
        }

        $form = new PostForm($post);

        if (!$form->isSubmitted()) {
            return Template::render('post.form', ['mode' => $mode, 'form' => $form, 'post' => $post]);
        }
        if (!$form->isValid()) {
            array_push($_SESSION['alerts'], new Alert('Saisie incorrecte'));

            return Template::render('post.form', ['mode' => $mode, 'form' => $form, 'post' => $post]);
        }

        if ('create' === $mode) {
            $post = Post::create($form->title, $form->intro, $form->content, $user->id);
        } else {
            $post->modify($form->title, $form->intro, $form->content);
        }

        $post = PostRepository::save($post);
        header(strtr('location: /posts/{id}', ['{id}' => $post->id]));
    }

    public function create()
    {
        return self::form('create', 'créer', '/posts');
    }

    public function edit($id)
    {
        $back_url = strtr('/posts/{id}', ['{id}' => $id]);

        return self::form('edit', 'modifier', $back_url, $id);
    }
}
