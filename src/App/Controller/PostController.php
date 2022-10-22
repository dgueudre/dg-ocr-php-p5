<?php

namespace App\Controller;

use Prout\Template;

class PostController
{
    public function list()
    {
        return 'actionList';
    }

    public function view($params)
    {
        return 'actionView '.$params['id'];
    }

    public function edit($params)
    {
        return Template::render('posts.edit', $params);
    }
}
