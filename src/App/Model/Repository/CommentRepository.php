<?php

namespace App\Model\Repository;

use App\Model\Entity\Comment;
use App\Model\Enum\CommentStatus;
use Prout\Database;
use Prout\SQL;

class CommentRepository
{
    public static function truncate()
    {
        $query = 'SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE TABLE comment;
        SET FOREIGN_KEY_CHECKS = 1;';
        Database::execute($query);
    }

    public static function create()
    {
        $query = 'CREATE TABLE comment (
            id INT AUTO_INCREMENT,
            comment VARCHAR(255) NOT NULL,
            _created_at VARCHAR(255) NOT NULL,
            _status '.SQL::enum(CommentStatus::class).' NOT NULL,
            post_id INT,
            author_id INT,
            PRIMARY KEY (id),
            CONSTRAINT comment_post_FK FOREIGN KEY(post_id) REFERENCES post(id),
            CONSTRAINT comment_user_FK FOREIGN KEY(author_id) REFERENCES user(id)
        );';
        Database::execute($query);
    }

    public static function save(Comment $comment): Comment
    {
        $query = 'INSERT 
        INTO comment(comment, _created_at, _status, post_id, author_id)
        VALUES (:comment, :created_at, :status, :post_id, :author_id);';

        $comment->id = Database::insert($query, [
            'comment' => $comment->comment,
            'created_at' => SQL::date($comment->created_at),
            'status' => CommentStatus::PENDING->name,
            'post_id' => $comment->post_id,
            'author_id' => $comment->author_id,
        ]);

        return $comment;
    }

    public static function findAllByPostId($postId, CommentStatus $status = null)
    {
        $query = 'SELECT *
            FROM comment
            WHERE post_id = :postId
            AND _status = COALESCE(:status, _status)';

        return Database::fetchAll($query, [
            'postId' => $postId,
            'status' => $status->name ?? null,
        ], Comment::class);
    }
}
