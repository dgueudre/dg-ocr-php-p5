<?php

namespace Prout;

class Form
{
    public static function validate($fields = []): bool
    {
        foreach ($fields as $name) {
            $value = $_POST[$name] ?? '';
            if (!$value) {
                return false;
            }
        }
        return true;
    }
}
