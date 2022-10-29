<?php

namespace App\Controller\Form;

use App\Model\Entity\Post;
use Prout\Form;

class PostForm extends Form
{
    public string $title = '';
    public string $intro = '';
    public string $content = '';

    public function __construct(?Post $post)
    {
        if ($this->isSubmitted()) {
            $this->title = $_POST['title'] ?? '';
            $this->intro = $_POST['intro'] ?? '';
            $this->content = $_POST['content'] ?? '';
        } elseif (isset($post)) {
            $this->title = $post->title;
            $this->intro = $post->intro;
            $this->content = $post->content;
        }
    }

    public function isValid()
    {
        return
            !empty($this->title)
            && !empty($this->intro)
            && !empty($this->content);
    }
}
