<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_code',
        'user_id',
        'customer_id',
        'coupon_id',
        'discount',
        'discount_price',
        'sub_total',
        'grand_total',
        'paid',
        'change',
        'valid',
    ];

    public function User()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Costumer()
    {
        $this->belongsTo(Costumer::class, 'customere_id', 'id');
    }

    public function Coupon()
    {
        $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
}
