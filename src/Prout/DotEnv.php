<?php

namespace Prout;

class DotEnv
{
    private static $vars = [];

    public static function init($file = ''): array
    {
        $content =  file_get_contents('../.env');
        preg_match_all('/(\w+)=(\w*)/', $content, $matches);
        [$_, $keys, $values] = $matches;
        self::$vars = array_combine($keys, $values);

        return self::$vars;
    }

    public static function get($name): string
    {
        return self::$vars[$name] ?? null;
    }
}
