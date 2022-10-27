<?php

namespace Prout;

class Database
{
    private static \PDO $db;
    private static string $dbname;
    private static bool $selected = false;

    public static function init($host, $dbname, $user, $pass): \PDO
    {
        self::$dbname = $dbname;

        // $str = strtr('mysql:host={host};dbname={db}', ['{host}' => $host, '{db}' => $db ]);
        $str = strtr('mysql:host={host}', ['{host}' => $host]);
        self::$db = new \PDO($str, $user, $pass);
        self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return self::$db;
    }

    public static function get(bool $nodb = false): \PDO
    {
        if ($nodb) {
            return self::$db;
        }
        if (!self::$selected) {
            $dbname = self::$dbname;
            self::$db->query("USE $dbname;");
        }

        return self::$db;
    }

    public static function lastInsertId(): int
    {
        return self::execute('SELECT LAST_INSERT_ID() AS id;')->fetchColumn();
    }

    public static function execute($query, $params = []): \PDOStatement
    {
        $statement = self::get()->prepare($query);
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
        $result = self::fetchAll($query, $params, $class);

        return reset($result);
    }
}
