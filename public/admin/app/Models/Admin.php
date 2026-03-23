<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // important for auth
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';      // matches your table name
    protected $primaryKey = 'id';

    protected $fillable = [
        'memberid', 'username', 'password', 'role'
    ];

    // Hide password in arrays/json
    protected $hidden = [
        'password',
    ];

    // If you want timestamps true (we created them), leave default
}
