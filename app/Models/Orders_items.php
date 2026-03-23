<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_items extends Model
{
    use HasFactory;
    

    protected $table = 'ecom_order_items';
    protected $guarded = [];
    public $timestamp = false;
}
