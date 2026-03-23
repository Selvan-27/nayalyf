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
        'cutoff_slot_id',
        'achieved_date'
    ];
    
    protected $dates = [
        'achieved_date',
        'created_at',
        'updated_at'
    ];
    
    // Relationship with awards_and_rewards_cutoff_slots
    public function cutoffSlot()
    {
        return $this->belongsTo(awards_and_rewards_cutoff_slots::class, 'cutoff_slot_id', 'id');
    }
    
    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class, 'memberid', 'memberid');
    }
}
