<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'total_price',
        'status',
        'address',
        'quantity',
        'order_number',
        'user_id',
        'product_id',
        'payment_method', // Tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
