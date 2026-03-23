<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class daily_challenge extends Model
{
    protected $table = 'daily_challenge';

    protected $fillable = [
        'user_id',
        'workflow_date',
        'morning_opened',
        'morning_opened_at',
        'night_opened',
        'night_opened_at'
    ];

    protected $casts = [
        'workflow_date' => 'date',
        'morning_opened' => 'boolean',
        'night_opened' => 'boolean',
        'morning_opened_at' => 'datetime',
        'night_opened_at' => 'datetime',
    ];
}