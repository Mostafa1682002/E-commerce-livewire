<?php

namespace App\Models;

use App\enums\StatusProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'name', 'slug', 'short_description',
        'description', 'regular_price', 'sale_price',
        'featured', 'quantity', 'main_image_1', 'main_image_2', 'status',
    ];

    protected $casts = [
        'status' => StatusProduct::class,
        'featured' => StatusProduct::class
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('qty', 'price');
    }






    protected function mainImage1(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
    protected function mainImage2(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
}
