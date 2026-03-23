<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team_performance_tree extends Model
{
    use HasFactory;

    protected $table = 'team_performance_tree';

    protected $fillable = [
        'memberid',
        'sponsorid',
        'placement_id',
        'pos',
        'tree_no',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tree_no' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
