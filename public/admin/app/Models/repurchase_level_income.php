<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repurchase_level_income extends Model
{
    use HasFactory;

    protected $table = 'repurchase_level_income';

    protected $fillable = [
        'memberid',
        'fromId',
        'level',
        'payout',
        'netpay',
        'cutoff_slot_id',
    ];

    protected $casts = [
        'payout' => 'decimal:2',
        'netpay' => 'decimal:2',
    ];
}
