<?php

namespace App\Models;

use App\enums\StatusHomeSlider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class HomeSlider extends Model
{
    use HasFactory;
    protected $fillable = [
        'top_title',
        'title',
        'sub_title',
        'offer',
        'image',
        'status',
    ];


    protected $casts = [
        'status' => StatusHomeSlider::class
    ];




    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
}
