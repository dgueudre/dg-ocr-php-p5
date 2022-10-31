<?php

namespace App\Model\Entity;

use Prout\Entity;

class Post extends Entity
{
    public int $id;
    public string $title;
    public string $intro;
    public string $content;
    public \DateTime $created_at;
    public ?\DateTime $edited_at = null;
    public readonly int $author_id;
    public int $nb_comment;

    public function __construct($params = null)
    {
        $this->id = 0;
        $this->nb_comment = 0;
        $this->created_at = new \DateTime();
        if ($params) {
            extract($params);
            $this->title = $title;
            $this->intro = $intro;
            $this->content = $content;
            $this->author_id = $author_id;
        }
    }

    public static function create(string $title, string $intro, string $content, int $author_id): Post
    {
        return new Post(compact('title', 'intro', 'content', 'author_id'));
    }

    public function modify(string $title, string $intro, string $content)
    {
        $this->edited_at = new \DateTime();
        $this->title = $title;
        $this->intro = $intro;
        $this->content = $content;
    }

    protected function sqlset_created_at(string $created_at)
    {
        $this->created_at = new \DateTime($created_at);
    }

    protected function sqlset_edited_at(?string $edited_at)
    {
        if ($edited_at) {
            $this->edited_at = new \DateTime($edited_at);
        }
    }
}
