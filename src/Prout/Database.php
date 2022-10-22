<?php

namespace Prout;

class Database
{
    private static $db = null;

    public static function init($host, $db, $user, $pass): \PDO
    {
        $str = strtr('mysql:host={host};dbname={db}', ['{host}' => $host, '{db}' => $db ]);
        self::$db = new \PDO($str, $user, $pass);
        self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return self::$db;
    }

    public static function get(): \PDO
    {
        return self::$db;
    }
}
