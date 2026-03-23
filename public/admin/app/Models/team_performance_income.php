<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team_performance_income extends Model
{
    use HasFactory;

    protected $table = 'team_performance_income';

    protected $fillable = [
        'memberid',
        'fromId',
      
        'tree_number',
        'amount',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tree_number' => 'integer',
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
