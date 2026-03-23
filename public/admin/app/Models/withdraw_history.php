<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdraw_history extends Model
{


    use HasFactory;

    protected $table = 'withdraw_history';
    
    protected $primaryKey = 'id';

}
