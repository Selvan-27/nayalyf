<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    

    protected $table = 'ecom_orders';
    protected $guarded = [];
    public $timestamp = false;
}
