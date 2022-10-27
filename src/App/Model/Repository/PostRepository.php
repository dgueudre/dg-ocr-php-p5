<?php

namespace App\Model\Repository;

use App\Model\Entity\Post;
use Prout\Database;
use Prout\SQL;

class PostRepository
{
    public static function truncate()
    {
        $query = 'SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE TABLE post;
        SET FOREIGN_KEY_CHECKS = 1;';
        Database::execute($query);
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
        Database::execute($query);
    }

    private static function insert(Post $post): Post
    {
        $post->created_at = new \DateTime();

        $query = 'INSERT 
        INTO post(title, intro, content, created_at, author_id)
        VALUES (:title, :intro, :content, :created_at, :author_id);';

        $post->id = Database::insert($query, [
            'title' => $post->title,
            'intro' => $post->intro,
            'content' => $post->content,
            'created_at' => SQL::date($post->created_at),
            'author_id' => $post->author_id,
        ]);

        $post->id = Database::lastInsertId();

        return $post;
    }

    private static function update(Post $post): Post
    {
        $post->edited_at = new \DateTime();

        $query = 'UPDATE post SET
                title = :title,
                intro = :intro,
                content = :content,
                edited_at = :edited_at
            WHERE id = :id;';

        Database::execute($query, [
           'title' => $post->title,
           'intro' => $post->intro,
           'content' => $post->content,
           'edited_at' => SQL::date($post->edited_at),
        ]);

        return $post;
    }

    public static function save(Post $post): Post
    {
        if (0 === $post->id) {
            return self::insert($post);
        }

        return self::update($post);
    }

    public static function findAll()
    {
        $query = 'SELECT * FROM post;';

        return Database::fetchAll($query, [], Post::class);
    }

    public static function findOneById($id)
    {
        $query = 'SELECT * 
            FROM post
            WHERE id = :id;';

        return Database::fetch($query, [
            'id' => $id,
        ], Post::class);
    }
}
