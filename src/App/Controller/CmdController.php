<?php

namespace App\Controller;

use App\Model\Fixture\UserFixture;
use App\Model\Repository\UserRepository;
use Prout\Database;
use Prout\DotEnv;

class CmdController
{
    public function userFixture()
    {
        UserFixture::run();
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
        echo "TABLE user CREATED !".PHP_EOL;
        UserFixture::run();
        echo "user data INSERTED !".PHP_EOL;
        return true;
    }
}
