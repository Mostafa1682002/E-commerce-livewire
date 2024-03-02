<?php

namespace App\enums;

enum StatusHomeSlider: int
{
    case DISACTIVE = 0;
    case ACTIVE = 1;

    public function slider()
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
