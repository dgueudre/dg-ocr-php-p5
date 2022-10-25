<?php

namespace Prout;

class ORM
{
    public static function hydrate(string $class)
    {
        return function (...$row) use ($class) {
            var_dump($row);
            exit;
            $object = new $class();
            foreach ($row as $field => $value) {
                $object->$field = $value;
            }

            return $object;
        };
    }
}
