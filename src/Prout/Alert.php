<?php

namespace Prout;

class Alert
{
    public function __construct(public readonly string $message, public readonly string $severity = 'info')
    {
    }
}
