<?php

namespace App\Model\Entity;

use App\Model\Enum\CommentStatus;

class Comment
{
    public int  $id;
    public string $comment;
    public string $created_date;
    public CommentStatus $status;
    public int $post_id;
    public int $author_id;

    public function __construct(string $comment, int $post_id, int $author_id)
    {
        $this->id = 0;
        $this->comment = $comment;
        $this->status = CommentStatus::PENDING;
        $this->post_id = $post_id;
        $this->author_id = $author_id;
    }
}
