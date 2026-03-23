<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repurchase_cutoff_slots extends Model
{
    use HasFactory;

    protected $table = 'repurchase_cutoff_slots';

    protected $fillable = [
        'name',
        'from_date',
        'to_date',
        'status',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];
}
