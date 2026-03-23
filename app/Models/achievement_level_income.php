<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achievement_level_income extends Model
{
    use HasFactory;

    protected $table = 'achievement_level_income';
    
    protected $fillable = [
        'memberid',
        'fromId',
        'level',
        'amount',
        'payout',
        'netpay',
        'eldate',
        'month_number'
    ];
}
