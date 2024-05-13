<?php

namespace App\Enum;

enum TokenAbility: string
{
    case REFRESH_TOKEN = 'refreshToken';
    case ACCESS_TOKEN = 'accessToken';
}
