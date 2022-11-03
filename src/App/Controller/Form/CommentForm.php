<?php

namespace App\Controller\Form;

use App\Model\Entity\Comment;
use Prout\Form;

class CommentForm extends Form
{
    public string $comment = '';

    public function __construct(?Comment $comment = null)
    {
        if ($this->isSubmitted()) {
            $this->comment = $_POST['comment'] ?? '';
        } elseif (isset($post)) {
            $this->comment = $comment->comment;
        }
    }

    public function isValid()
    {
        return !empty($this->comment);
    }
}
