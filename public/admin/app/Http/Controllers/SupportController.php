<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::orderBy('created_at', 'desc')->paginate(20);
        return view('support.index', compact('tickets'));
    }

    public function show(Request $request)
    {
        $ticket = SupportTicket::where('ticket_id',$request->id)->first();
        
        $username = User::where('memberid',$ticket->user_id)->value('name');
        
        $messages = TicketMessage::where('ticket_id', $ticket->ticket_id)->orderBy('created_at')->get();

        return view('support.show', compact('ticket', 'messages','username'));
    }

    public function reply(Request $request, $id)
    {
       $ticket = SupportTicket::where('ticket_id',$id)->first();


           // Check if ticket exists
    if (!$ticket) {
        return redirect()->back()->with('error', 'Ticket not found.');
    }

    // If request status is "Close", update it
    if ($request->status === "Close") {
        $ticket->status = "Close";
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket has been closed successfully.');
    }
    
        TicketMessage::create([
            'ticket_id' => $ticket->ticket_id,
            'sender_role' => 'Admin',
            // 'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Reply sent.');
    }

    public function changeStatus(Request $request, $id)
    {
        
//return $id=$request-id;
         // Find ticket by ticket_id (not database ID)
   return $ticket = SupportTicket::where('ticket_id', $id)->first();

    if (!$ticket) {
        return redirect()->back()->with('error', 'Ticket not found.');
    }

    // Update status
    $ticket->status = $request->status;
    $ticket->save();

    return redirect()->back()->with('success', 'Ticket status updated to ' . ucfirst($request->status));
    }
}
