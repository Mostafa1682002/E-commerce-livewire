<?php

namespace App\enums;

enum StatusOrder: int
{
    case PENDING = 0;
    case PROCESSING = 1;
    case COMPLETED = 2;
    case CANCELED = 3;


    public function order()
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::COMPLETED => 'Completed',
            self::CANCELED => 'Canceled',
        };
    }
    public function badge()
    {
        return match ($this) {
            self::PENDING => 'bg-primary',
            self::PROCESSING => 'bg-warning',
            self::COMPLETED => 'bg-success',
            self::CANCELED => 'bg-danger',
        };
    }
}
