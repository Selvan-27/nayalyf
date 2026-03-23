<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaders_matrix_tree extends Model
{
    use HasFactory;

    protected $table = 'leaders_matrix_tree';

    protected $fillable = [
        'memberid',
        'sponsor_id',
        'placement_id',
        'tree_no',
        'position',
        'all_father_id',
        'original_id'
    ];

    protected $casts = [
        'tree_no' => 'integer',
        'position' => 'integer'
    ];
}