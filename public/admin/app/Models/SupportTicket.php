<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;


    protected $table = 'support_tickets';
    protected $primaryKey = 'ticket_id';
    protected $fillable = [
        'ticket_id', 'user_id', 'subject', 'issue_type', 'status', 'created_at', 'updated_at'
    ];
}
