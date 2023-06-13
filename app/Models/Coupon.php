<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_code', 'user_id', 'description',
        'product_category_id', 'expired',
        'status', 'discount'
    ];

    protected $hidden = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
