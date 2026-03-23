<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class topupdetails extends Model
{
    use HasFactory;

    protected $table = 'topupdetails';

    protected $fillable = [
        'loginid',
        'memberid',
        'amount',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;
}
