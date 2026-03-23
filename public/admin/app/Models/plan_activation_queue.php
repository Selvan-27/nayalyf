<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plan_activation_queue extends Model
{
    use HasFactory;

    // Specify the table if not "categories"
    protected $table = 'plan_activation_queue';
      protected $guarded = [];
    public $timestamp = false;

   
}
