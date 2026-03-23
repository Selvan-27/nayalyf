<?php

namespace App\Http\Controllers;

use App\Models\support;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Auth;
class SupportController extends Controller
{
    
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::user()->memberid)->latest()->get();
        return view('Support.SupportTicket', compact('tickets'));
    }

    public function show(Request $request)
    {      
        $id=$request->id;
        $ticket = SupportTicket::where('ticket_id', $id)->firstOrFail();


        $messages = TicketMessage::where('ticket_id', $ticket->ticket_id)->latest()->get();

        return view('Support.SupportTicket_reply', compact('ticket', 'messages'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

    
        $ticket = SupportTicket::where('ticket_id',$id)->first();

        TicketMessage::create([
            'ticket_id' => $ticket->ticket_id,
            'sender_role' => 'User',
            'sender_id' => Auth::user()->memberid,
            'message' => $request->message,
        ]);

        // Optional: update ticket timestamp/status
$ticket->status = 'Open'; // Reopen if user replies
$ticket->save();

        return redirect()->back()->with('success', 'Your message has been sent.');
    }

    public function create()
    {
        return view('Support.create_ticket');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'description' => 'required',
            'issue_type' => 'required|max:100',
        ]);

        $ticket = SupportTicket::create([
            'user_id' => Auth::user()->memberid,
            'subject' => $request->subject,
            'description' => $request->description,
            'issue_type' => $request->issue_type,
        ]);

        // Initial message (optional)
        TicketMessage::create([
            'ticket_id' => $ticket->ticket_id,
            'sender_role' => 'User',
            'sender_id' => Auth::user()->memberid,
            'message' => $request->description,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }
}
