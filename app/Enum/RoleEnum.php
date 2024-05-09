<?php

namespace App\Enum;

enum RoleEnum: int
{
    case ADMIN = 1;
    case MODERATOR = 2;
    case USER = 3;
}
