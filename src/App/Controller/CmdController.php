<?php

namespace App\Controller;

use App\Model\Fixture\BlogFixture;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\PostRepository;
use App\Model\Repository\UserRepository;
use Prout\Database;
use Prout\DotEnv;

class CmdController
{
    public function userFixture()
    {
        BlogFixture::run();

        return true;
    }

    public function install()
    {
        $dbname = DotEnv::get('DB_NAME');
        Database::get(true)->query("DROP DATABASE IF EXISTS $dbname;");
        echo "DATABASE $dbname DROP !".PHP_EOL;
        Database::get(true)->query("CREATE DATABASE IF NOT EXISTS $dbname;");
        echo "DATABASE $dbname CREATED !".PHP_EOL;
        UserRepository::create();
        echo 'TABLE user CREATED !'.PHP_EOL;
        PostRepository::create();
        echo 'TABLE post CREATED !'.PHP_EOL;
        CommentRepository::create();
        echo 'TABLE comment CREATED !'.PHP_EOL;
        BlogFixture::run();
        echo 'blog data INSERTED !'.PHP_EOL;

        return true;
    }
}
