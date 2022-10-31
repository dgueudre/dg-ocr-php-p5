<?php

namespace Prout;

class Template
{
    public static function render($file, $params = [])
    {
        extract($params);

        ob_start();
        include "src/App/View/$file.php";

        return ob_get_clean();
    }
}
