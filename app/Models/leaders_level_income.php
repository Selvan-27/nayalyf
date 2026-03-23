<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaders_level_income extends Model
{
    use HasFactory;

    protected $table = 'leaders_level_income';

    protected $fillable = [
        'memberid',
        'fromId',
        'level',
        'payout',
        'netpay',
        'cutoff_slot_id',
        'repurchase_count'
    ];

    protected $casts = [
        'payout' => 'decimal:2',
        'netpay' => 'decimal:2',
        'level' => 'integer',
        'repurchase_count' => 'integer',
        'cutoff_slot_id' => 'integer'
    ];
}