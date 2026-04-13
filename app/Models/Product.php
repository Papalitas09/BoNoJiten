<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'categories',
        'status',
        'image'
    ];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function favoritedBy()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoritedBy($userId)
    {
        return $this->favoritedBy()->where('user_id', $userId)->exists();
    }
}
