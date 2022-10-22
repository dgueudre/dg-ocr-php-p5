<?php

namespace Prout;

class DotEnv
{
    private static $vars = [];

    public static function init($file = '.env'): array
    {
        $content =  file_get_contents($file);
        preg_match_all('/(\w+)=(\w*)/', $content, $matches);
        [$_, $keys, $values] = $matches;
        self::$vars = array_combine($keys, $values);

        return self::$vars;
    }

    public static function get($name): string | null
    {
        return self::$vars[$name] ?? null;
    }
}
