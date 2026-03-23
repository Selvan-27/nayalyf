<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaders_level_tracking extends Model
{
    use HasFactory;

    protected $table = 'leaders_level_tracking';

    protected $fillable = [
        'memberid',
        'level_1_memberid',
        'level_2_memberid',
        'level_3_memberid',
        'level',
        'cutoff_slot_id',
        'repurchase_count',
        'total_accumulated_count',
        'consecutive_count',
        'total_income_paid',
        'last_paid_threshold',
        'is_qualified',
        'last_income_at'
    ];

    protected $casts = [
        'repurchase_count' => 'integer',
        'total_accumulated_count' => 'integer',
        'consecutive_count' => 'integer',
        'level' => 'integer',
        'total_income_paid' => 'decimal:2',
        'last_paid_threshold' => 'integer',
        'is_qualified' => 'boolean',
        'cutoff_slot_id' => 'integer',
        'last_income_at' => 'datetime'
    ];
}