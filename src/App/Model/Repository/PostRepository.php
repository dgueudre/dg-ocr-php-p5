<?php

namespace App\Model\Repository;

use App\Model\Entity\Post;
use Prout\Database;

class PostRepository
{
    public static function truncate()
    {
        $query = 'SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE TABLE post;
        SET FOREIGN_KEY_CHECKS = 1;';
        Database::get()->query($query);
    }

    public static function create()
    {
        $query = 'CREATE TABLE post (
            id INT AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            intro VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at VARCHAR(255) NOT NULL,
            edited_at VARCHAR(255),
            author_id INT,
            PRIMARY KEY (id),
            CONSTRAINT post_user_FK FOREIGN KEY(author_id) REFERENCES user(id)
        );';
        Database::get()->query($query);
    }

    public static function save(Post $post): Post
    {
        $query = 'INSERT 
        INTO post(title, intro, content, created_at, author_id)
        VALUES (:title, :intro, :content, NOW(), :author_id);';
        $statement = Database::get()->prepare($query);
        $statement->execute([
            'title' => $post->title,
            'intro' => $post->intro,
            'content' => $post->content,
            'author_id' => $post->author_id,
        ]);

        $post->id = Database::lastInsertId();

        return $post;
    }
}
