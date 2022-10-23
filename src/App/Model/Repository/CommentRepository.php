<?php

namespace App\Model\Repository;

use App\Model\Entity\Comment;
use App\Model\Enum\CommentStatus;
use Prout\Database;

class CommentRepository
{
    public static function truncate()
    {
        $query = 'SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE TABLE comment;
        SET FOREIGN_KEY_CHECKS = 1;';
        Database::get()->query($query);
    }

    public static function create()
    {
        $query = 'CREATE TABLE comment (
            id INT AUTO_INCREMENT,
            comment VARCHAR(255) NOT NULL,
            created_at VARCHAR(255) NOT NULL,
            status VARCHAR(255) NOT NULL,
            post_id INT,
            author_id INT,
            PRIMARY KEY (id),
            CONSTRAINT comment_post_FK FOREIGN KEY(post_id) REFERENCES post(id),
            CONSTRAINT comment_user_FK FOREIGN KEY(author_id) REFERENCES user(id)
        );';
        Database::get()->query($query);
    }

    public static function save(Comment $comment): Comment
    {
        $query = 'INSERT 
        INTO comment(comment, created_at, status, post_id, author_id)
        VALUES (:comment, NOW(), :status, :post_id, :author_id);';
        $statement = Database::get()->prepare($query);
        $statement->execute([
            'comment' => $comment->comment,
            'status' => CommentStatus::PENDING->name,
            'post_id' => $comment->post_id,
            'author_id' => $comment->author_id,
        ]);

        $comment->id = Database::lastInsertId();

        return $comment;
    }
}
