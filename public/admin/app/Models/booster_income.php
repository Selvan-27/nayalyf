<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booster_income extends Model
{
    use HasFactory;


    protected $table = 'booster_income';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamp = false;

}
