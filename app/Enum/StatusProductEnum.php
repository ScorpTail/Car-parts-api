<?php

namespace App\Enum;

enum StatusProductEnum: int
{
    case AVAIABLE = 1;
    case NOTAVAIABLE = 2;
    case ENDED = 3;

    public function label(): string
    {
        return match ($this) {
            self::AVAIABLE => 'Available',
            self::NOTAVAIABLE => 'Not Available',
            self::ENDED => 'Ended',
            default => 'Available',
        };
    }
}
