<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plan_activation_queue extends Model
{
    use HasFactory;

    protected $table = 'plan_activation_queue';

    protected $fillable = [
        'activation_id',
        'activation_status',
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'activation_status' => 'pending'
    ];

    public $timestamps = true;

    // Define the valid status values
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    // Scope for pending activations
    public function scopePending($query)
    {
        return $query->where('activation_status', self::STATUS_PENDING);
    }

    // Scope for failed activations
    public function scopeFailed($query)
    {
        return $query->where('activation_status', self::STATUS_FAILED);
    }

    // Scope for processing activations
    public function scopeProcessing($query)
    {
        return $query->where('activation_status', self::STATUS_PROCESSING);
    }

    // Scope for successful activations
    public function scopeSuccess($query)
    {
        return $query->where('activation_status', self::STATUS_SUCCESS);
    }

    // Check if there are any failed or processing records
    public static function hasFailedOrProcessingRecords()
    {
        return self::whereIn('activation_status', [self::STATUS_FAILED, self::STATUS_PROCESSING])->exists();
    }

    // Get the MLM plan for this activation
    public function mlmPlan()
    {
        return $this->belongsTo(mlm_plan::class, 'activation_id', 'memberid');
    }
}