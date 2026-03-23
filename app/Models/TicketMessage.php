<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'support_ticket_messages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ticket_id', 'sender_role', 'sender_id', 'message', 'created_at', 'updated_at'
    ];
}
