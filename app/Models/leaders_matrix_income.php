<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaders_matrix_income extends Model
{
    use HasFactory;

    protected $table = 'leaders_matrix_income';

    protected $fillable = [
        'memberid',
        'fromId',
        'tree_number',
        'payout',
        'netpay',
        'ignored',
        'all_father_id'
    ];

    protected $casts = [
        'payout' => 'decimal:2',
        'netpay' => 'decimal:2',
        'tree_number' => 'integer',
        'ignored' => 'integer'
    ];
}