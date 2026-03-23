<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mlm_plan extends Model
{
    use HasFactory;

    protected $table = 'mlm_plan';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'memberid',
        'FullName',
        'email',
        'mobile',
        'sponser_id',
        'memberid_type',
        'status'
    ];

    /**
     * Get the activation queue for this member
     */
    public function activationQueue()
    {
        return $this->hasOne(plan_activation_queue::class, 'activation_id', 'memberid');
    }

    /**
     * Get the sponsor for this member
     */
    public function sponsor()
    {
        return $this->belongsTo(mlm_plan::class, 'sponser_id', 'memberid');
    }

    /**
     * Get all direct referrals for this member
     */
    public function directReferrals()
    {
        return $this->hasMany(mlm_plan::class, 'sponser_id', 'memberid');
    }

    /**
     * Get all income records for this member
     */
    public function incomes()
    {
        return $this->hasMany(income_all::class, 'memberid', 'memberid');
    }

    /**
     * Get all withdrawal records for this member
     */
    public function withdrawals()
    {
        return $this->hasMany(withdraw_history::class, 'memberid', 'memberid');
    }
}