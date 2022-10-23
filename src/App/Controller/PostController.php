<?php

namespace App\Controller;

use App\Model\Repository\PostRepository;
use App\Model\Repository\UserRepository;
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
        return Template::render('post.edit', $params);
    }
}
