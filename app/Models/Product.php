<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function sizes(){
        return $this->hasMany(Size::class);
    }
}
