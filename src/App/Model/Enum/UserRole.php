<?php

namespace App\Model\Enum;

enum UserRole: string
{
    case USER = 'USER';
    case ADMIN = 'ADMIN';
}
