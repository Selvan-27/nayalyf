<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team_performance_queue extends Model
{
    use HasFactory;

    protected $table = 'team_performance_queue';

    protected $fillable = [
        'login_id',
        'activation_id',
        'board',
        'activation_turn_id',
        'status',
        'activation_status',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'board' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
