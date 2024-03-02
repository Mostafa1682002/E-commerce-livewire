<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'email',
        'address',
        'logo',
        'ins_link',
        'tw_link',
        'face_link',
        'you_link',
    ];
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
}
