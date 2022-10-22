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
}
