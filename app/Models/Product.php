<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_code',
        'deskripsi',
        'name',
        'slug',
        'selling_price',
        'purchase_price',
        'stock',
        'category_id',
    ];

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function Gallery()
    {
        return $this->belongsTo(ProductGallery::class, 'id');
    }
}
