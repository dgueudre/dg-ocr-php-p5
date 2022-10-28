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

    public static function lastInsertId(): int
    {
        return self::execute('SELECT LAST_INSERT_ID() AS id;')->fetchColumn();
    }

    public static function execute($query, $params = [], $needDb = true): \PDOStatement
    {
        $statement = self::get($needDb)->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    public static function insert($query, $params): int
    {
        self::execute($query, $params);

        return self::lastInsertId();
    }

    public static function fetchAll($query, $params, $class)
    {
        $statement = self::execute($query, $params);

        return $statement->fetchAll(\PDO::FETCH_FUNC, [$class, 'fromSQL']);
    }

    public static function fetch($query, $params, $class)
    {
        $statement = self::execute($query, $params);
        $result = $statement->fetch(\PDO::FETCH_NUM);

        if (!$result) {
            return false;
        }

        return $class::fromSQL(...$result);
    }
}
