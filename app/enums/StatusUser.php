<?php

namespace App\enums;

enum StatusUser: int
{
    case DISACTIVE = 0;
    case ACTIVE = 1;

    public function user()
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::DISACTIVE => 'Disactive',
        };
    }
    public function badge()
    {
        return match ($this) {

            self::ACTIVE => 'bg-success',
            self::DISACTIVE => 'bg-danger',
        };
    }
}
