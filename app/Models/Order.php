<?php

namespace App\Models;

use App\enums\StatusOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'address2',
        'city',
        'notes',
        'subtotal',
        'tax',
        'total',
        'discount',
        'status',
    ];

    protected $casts = [
        'status' => StatusOrder::class
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty', 'price');
    }
}
