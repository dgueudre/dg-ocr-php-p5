<?php

namespace Prout;

class SQL
{
    public static function enum($enum)
    {
        $sql = 'ENUM (' . implode(", ", array_map(function ($item) {
            return "'$item->name'";
        }, $enum::cases())) . ')';

        return $sql;
    }
}
