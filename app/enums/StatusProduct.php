<?php

namespace App\enums;

enum StatusProduct: int
{
    case DISACTIVE = 0;
    case ACTIVE = 1;

    public function product()
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::DISACTIVE => 'Disactive',
        };
    }
    public function featured()
    {
        return match ($this) {
            self::ACTIVE => 'Yes',
            self::DISACTIVE => 'No',
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
