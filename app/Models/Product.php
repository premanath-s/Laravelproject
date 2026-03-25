<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory;
   protected $fillable = ['name','price','description','image', 'images'];

   protected $casts = [
       'images' => 'array',
   ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, '/images/') || str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        if (str_starts_with($this->image, '/storage/')) {
            return $this->image;
        }

        return '/storage/' . $this->image;
    }

    public function getImageUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return array_map(function ($image) {
            if (str_starts_with($image, '/images/') || str_starts_with($image, 'http')) {
                return $image;
            }

            if (str_starts_with($image, '/storage/')) {
                return $image;
            }

            return '/storage/' . $image;
        }, $this->images);
    }

public function carts()
{
    return $this->hasMany(Cart::class);
}

public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}


