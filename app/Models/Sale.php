<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'transaction_code',
        'product_price',
        'quantity',
        'total_price',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
