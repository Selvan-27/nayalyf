<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fast_track_income extends Model
{
    use HasFactory;

    protected $table = 'fast_track_income';
    
    protected $fillable = [
        'memberid',
        'from_memberid',
        'board_no',
        'amount',
        'income_type',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(mlm_plan::class, 'memberid', 'memberid');
    }

    public function fromUser()
    {
        return $this->belongsTo(mlm_plan::class, 'from_memberid', 'memberid');
    }
}
