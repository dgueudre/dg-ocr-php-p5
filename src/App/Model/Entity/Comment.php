<?php

namespace App\Model\Entity;

use App\Model\Enum\CommentStatus;
use Prout\Entity;

class Comment extends Entity
{
    public int  $id;
    public string $comment;
    public \DateTime $created_at;
    public CommentStatus $status;
    public int $post_id;
    public int $author_id;

    public function __construct($params = null)
    {
        $this->id = 0;
        $this->status = CommentStatus::PENDING;
        $this->created_at = new \DateTime();
        if ($params) {
            extract($params);
            $this->comment = $comment;
            $this->post_id = $post_id;
            $this->author_id = $author_id;
        }
    }

    public static function create(string $comment, int $post_id, int $author_id): Comment
    {
        return new Comment(compact('comment', 'post_id', 'author_id'));
    }

    protected function sqlset_status(string $status)
    {
        $this->status = CommentStatus::from($status);
    }

    protected function sqlset_created_at(string $created_at)
    {
        $this->created_at = new \DateTime($created_at);
    }
}
