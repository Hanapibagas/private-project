<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_code', 'product_id',
        'product_price', 'quantity', 'total_price'
    ];

    protected $hidden = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function transakasi()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_code');
    }
}
