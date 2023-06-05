<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_code', 'name', 'description',
        'product_category_id', 'expired',
        'status', 'discount'
    ];

    protected $hidden = [];
}
