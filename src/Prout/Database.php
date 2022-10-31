<?php

namespace Prout;

class Database
{
    private static $host;
    private static $dbname;
    private static $user;
    private static $pass;

    private static \PDO $connection;
    private static bool $dbSelected = false;

    public static function init($host, $dbname, $user, $pass): void
    {
        self::$host = $host;
        self::$dbname = $dbname;
        self::$user = $user;
        self::$pass = $pass;
    }

    private static function connect(bool $needDb = true): \PDO
    {
        if ($needDb) {
            $str = strtr('mysql:host={host};dbname={dbname}', ['{host}' => self::$host, '{dbname}' => self::$dbname]);
            self::$dbSelected = true;
        } else {
            $str = strtr('mysql:host={host}', ['{host}' => self::$host]);
            self::$dbSelected = false;
        }
        self::$connection = new \PDO($str, self::$user, self::$pass);
        self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return self::$connection;
    }

    private static function selectDb(): \PDO
    {
        if (!isset(self::$connection)) {
            return self::connect(true);
        }
        if (!self::$dbSelected) {
            $dbname = self::$dbname;
            self::$connection->query("USE $dbname;");
            self::$dbSelected = true;
        }

        return self::$connection;
    }

    private static function get(bool $needDb = true): \PDO
    {
        if ($needDb) {
            return self::selectDb();
        }
        if (!isset(self::$connection)) {
            return self::connect(false);
        }

        return self::$connection;
    }

    public static function execute($query, $params = [], $needDb = true): \PDOStatement
    {
        $statement = self::get($needDb)->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    public static function insert($query, $params, $obj): object
    {
        self::execute($query, $params);

        $query = 'SELECT LAST_INSERT_ID() AS id;';

        $statement = self::execute($query);
        $statement->setFetchMode(\PDO::FETCH_INTO, $obj);

        return $statement->fetch();
    }

    public static function fetchAll($query, $params, $class)
    {
        $statement = self::execute($query, $params);

        return $statement->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
    }

    public static function fetch($query, $params, $class)
    {
        $statement = self::execute($query, $params);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);

        return $statement->fetch();
    }
}
