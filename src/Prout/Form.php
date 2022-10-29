<?php

namespace Prout;

abstract class Form
{
    public function isSubmitted()
    {
        return !empty($_POST);
    }
}
