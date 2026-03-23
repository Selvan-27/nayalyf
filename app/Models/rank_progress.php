<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rank_progress extends Model
{
    use HasFactory;

    protected $table = 'rank_progress';
    
    protected $fillable = [
        'memberid',
        'level',
        'achievement_count'
    ];
}