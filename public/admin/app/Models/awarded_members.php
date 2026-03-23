<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class awarded_members extends Model
{
    use HasFactory;

    protected $table = 'awarded_members';
    
    protected $fillable = [
        'memberid',
        'award',
        'cutoff_slot_id'
    ];

    public function cutoffSlot()
    {
        return $this->belongsTo(awards_and_rewards_cutoff_slots::class, 'cutoff_slot_id');
    }
}