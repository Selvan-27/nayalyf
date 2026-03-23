<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fast_track_tree extends Model
{
    use HasFactory;

    protected $table = 'fast_track_tree';
    
    protected $fillable = [
        'memberid',
        'placement_id',
        'pos',
        'tree_no',
        'level',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(mlm_plan::class, 'memberid', 'memberid');
    }
}
