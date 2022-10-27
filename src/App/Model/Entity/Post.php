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

    public function __construct(string $title, string $intro, string $content, int $author_id)
    {
        $this->id = 0;
        $this->title = $title;
        $this->intro = $intro;
        $this->content = $content;
        $this->author_id = $author_id;
    }

    public static function fromSQL(int $id, string $title, string $intro, string $content, string $created_at, string|null $edited_at, int $author_id): static
    {
        $new = new static($title, $intro, $content, $author_id);
        $new->id = $id;
        $new->created_at = new \DateTime($created_at);
        if ($edited_at) {
            $edited_at = new \DateTime($edited_at);
        }

        return $new;
    }
}
