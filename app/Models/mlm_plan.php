<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mlm_plan extends Model
{
    use HasFactory;

    protected $table = 'mlm_plan';

    protected $fillable = [
        'memberid',
        'sponsor_id',
        'placement_id',
        'referral_count',
        'memberid_type',
        'original_id',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'referral_count' => 'integer',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
