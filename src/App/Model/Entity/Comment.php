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

    public static function fromSQL(int $id, string $comment, string $created_at, string $rawStatus, string $post_id, int $author_id): static
    {
        $new = new static($comment, $post_id, $author_id);
        $new->status = CommentStatus::from($rawStatus);
        $new->id = $id;
        $new->created_at = new \DateTime($created_at);

        return $new;
    }
}
