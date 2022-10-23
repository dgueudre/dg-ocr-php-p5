<?php

namespace App\Model\Entity;

class Post
{
    public int  $id;
    public string $title;
    public string $intro;
    public string $content;
    public string $created_at;
    public string | null $edited_at;
    public int $author_id;
}
