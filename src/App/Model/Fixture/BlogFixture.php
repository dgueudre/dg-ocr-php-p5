<?php

namespace App\Model\Fixture;

use App\Model\Entity\Comment;
use App\Model\Entity\Post;
use App\Model\Entity\User;
use App\Model\Enum\UserRole;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\PostRepository;
use App\Model\Repository\UserRepository;
use Prout\SQL;

class BlogFixture
{
    public static function lorem($nb_char = 0)
    {
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed interdum vel augue a efficitur. Aenean posuere, sem non tincidunt sagittis, magna leo dapibus turpis, vitae lobortis nisi libero eu augue. Aliquam libero libero, suscipit nec dapibus sed, tincidunt ac arcu. Etiam non efficitur elit. Etiam dapibus diam id nisl euismod sagittis. Proin ex elit, congue in volutpat a, hendrerit non neque. Phasellus at ligula et lectus fermentum blandit a ac nunc. Praesent sodales sit amet mauris quis sagittis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus malesuada augue auctor placerat feugiat. Fusce ac hendrerit tellus, ut dapibus dolor. Curabitur eget felis et dolor volutpat faucibus.';
        if ($nb_char) {
            $text = substr($text, 0, $nb_char);
        }
        return $text;
    }

    public static function run()
    {
        CommentRepository::truncate();
        PostRepository::truncate();
        UserRepository::truncate();

        // https://randomuser.me/
        $user = new User();
        $user->lastname = "Wilson";
        $user->firstname = "Toni";
        $user->email = "toni.wilson@example.com";
        $user->password = "skirt";
        $user->role = UserRole::ADMIN->name;
        $user = UserRepository::save($user);

        $post = new Post();
        $post->title = self::lorem(25);
        $post->intro = self::lorem(50);
        $post->content = self::lorem();
        $post->author_id = $user->id;
        $post = PostRepository::save($post);

        $post = new Post();
        $post->title = self::lorem(25);
        $post->intro = self::lorem(50);
        $post->content = self::lorem();
        $post->author_id = $user->id;
        $post = PostRepository::save($post);

        $comment = new Comment();
        $comment->comment = self::lorem(50);
        $comment->post_id = $post->id;
        $comment->author_id = $user->id;
        $comment = CommentRepository::save($comment);


        $user = new User();
        $user->lastname = "Chapman";
        $user->firstname = "Mathew";
        $user->email = "mathew.chapman@example.com";
        $user->password = "trucks";
        $user->role = UserRole::ADMIN->name;
        $user = UserRepository::save($user);

        $post = new Post();
        $post->title = self::lorem(25);
        $post->intro = self::lorem(50);
        $post->content = self::lorem();
        $post->author_id = $user->id;
        $post = PostRepository::save($post);

        $post = new Post();
        $post->title = self::lorem(25);
        $post->intro = self::lorem(50);
        $post->content = self::lorem();
        $post->author_id = $user->id;
        $post = PostRepository::save($post);

        $comment = new Comment();
        $comment->comment = self::lorem(50);
        $comment->post_id = $post->id;
        $comment->author_id = $user->id;
        $comment = CommentRepository::save($comment);

        $post = new Post();
        $post->title = self::lorem(25);
        $post->intro = self::lorem(50);
        $post->content = self::lorem();
        $post->author_id = $user->id;
        $post = PostRepository::save($post);

        $comment = new Comment();
        $comment->comment = self::lorem(50);
        $comment->post_id = $post->id;
        $comment->author_id = $user->id;
        $comment = CommentRepository::save($comment);


        $user = new User();
        $user->lastname = "Harper";
        $user->firstname = "Shannon";
        $user->email = "shannon.harper@example.com";
        $user->password = "wrestler";
        $user->role = UserRole::USER->name;
        $user = UserRepository::save($user);

        $comment = new Comment();
        $comment->comment = self::lorem(50);
        $comment->post_id = $post->id;
        $comment->author_id = $user->id;
        $comment = CommentRepository::save($comment);


        $user = new User();
        $user->lastname = "Henry";
        $user->firstname = "Minnie";
        $user->email = "minnie.henry@example.com";
        $user->password = "ventura";
        $user->role = UserRole::USER->name;
        $user = UserRepository::save($user);

        $comment = new Comment();
        $comment->comment = self::lorem(50);
        $comment->post_id = $post->id;
        $comment->author_id = $user->id;
        $comment = CommentRepository::save($comment);
    }
}
