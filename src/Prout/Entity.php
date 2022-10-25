<?php

namespace Prout;

abstract class Entity
{
    public function __set($name, $value)
    {
        $method = 'set'.ucfirst($name);
        if (method_exists($this, $method)) {
            $this->$method($value);

            return $this;
        }
        $this->$name = $value;

        return $this;
    }

    public function __get($name)
    {
        $method = 'get'.ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return $this->$name;
    }
}
