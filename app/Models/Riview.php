<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'riview'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'usere_id', 'id');
    }
}
