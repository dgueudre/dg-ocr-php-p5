<?php

namespace App\Controller;

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
        return 'actionEdit '.$params['id'].' '.$params['tata'];
    }
}
