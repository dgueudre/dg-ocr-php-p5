<?php

namespace Prout;

abstract class Entity
{
    public function __set($name, $value)
    {
        $method = 'sqlset'.$name;
        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $value);
        } else {
            $this->$name = $value;
        }

        return $this;
    }
}
