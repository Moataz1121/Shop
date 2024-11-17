<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory , Notifiable;

    protected $guarded = ['id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function sizes(){
        return $this->belongsToMany(Size::class, 'product_size');
   
    }
}
