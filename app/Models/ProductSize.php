<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_size'; 
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'product_id',
        'size_id',
    ];
}
