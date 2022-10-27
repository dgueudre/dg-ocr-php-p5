<?php

namespace App\Model\Enum;

enum CommentStatus: string
{
    case PENDING = 'PENDING';
    case CONFIRMED = 'COMFIRMED';
}
