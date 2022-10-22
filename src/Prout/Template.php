<?php

namespace Prout;

class Template
{
    public static function render($file, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include "../src/App/View/$file.php";

        return ob_get_clean();
    }
}
