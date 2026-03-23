<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cutoff_dates extends Model
{
    use HasFactory;

    protected $table = 'cutoff_dates';
    
    protected $fillable = [
        'from_date', 
        'to_date',
        'type'
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

}