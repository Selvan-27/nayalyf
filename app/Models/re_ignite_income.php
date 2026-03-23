<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class re_ignite_income extends Model
{
    use HasFactory;

    protected $table = 're_ignite_income';

    protected $fillable = [
        'original_id',
        'rebirth_id',
        'amount',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
