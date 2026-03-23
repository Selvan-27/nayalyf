<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class awards_and_rewards_cutoff_slots extends Model
{
    use HasFactory;

    protected $table = 'awards_and_rewards_cutoff_slots';
    
    protected $fillable = [
        'name',
        'from_date', 
        'to_date',
        'status'
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    public function awardedMembers()
    {
        return $this->hasMany(awarded_members::class, 'cutoff_slot_id');
    }
}