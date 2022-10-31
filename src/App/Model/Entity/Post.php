<?php

namespace App\Model\Entity;

class Post
{
    public int $id;
    public string $title;
    public string $intro;
    public string $content;
    public \DateTime $created_at;
    public \DateTime $edited_at;
    public readonly int $author_id;
    public int $nb_comment;

    public function __construct(string $title, string $intro, string $content, int $author_id)
    {
        $this->id = 0;
        $this->title = $title;
        $this->intro = $intro;
        $this->content = $content;
        $this->author_id = $author_id;
        $this->nb_comment = 0;
    }

    public function modify(string $title, string $intro, string $content)
    {
        $this->title = $title;
        $this->intro = $intro;
        $this->content = $content;
    }
}
