<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsTransaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaksi_id', 'product_id', 'jumlah'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
