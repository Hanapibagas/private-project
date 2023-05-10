<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
    ];

    public function Product()
    {
        $this->belongsTo(Product::class, 'product_id', 'id');
    }
}