<?php

namespace App\Model\Entity;

class Comment
{
    public int  $id;
    public string $comment;
    public string $created_date;
    public string $status;
    public int $post_id;
    public int $author_id;
}
