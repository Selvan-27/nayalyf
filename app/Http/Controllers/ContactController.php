<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    // Dashboard + Contact listing
    public function index()
    {
        $contacts = DB::table('todo_contacts')->orderBy('id', 'asc')->get();

        $totalContacts = DB::table('todo_contacts')->count();
        $activeContacts = DB::table('todo_contacts')->where('status', 'Active')->count();
        $scheduledCalls = DB::table('todo_scheduled_calls')->count();
        $overdueCalls = DB::table('todo_scheduled_calls')
                            ->where('scheduled_date', '<', now())
                            ->where('status', '!=', 'Completed')
                            ->count();

        return view('Todo.index', compact(
            'contacts', 'totalContacts', 'activeContacts', 'scheduledCalls', 'overdueCalls'
        ));
    }

      public function showLog($id)
    {
        $contact = DB::table('todo_contacts')->where('id', $id)->first();
        if (!$contact) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found.');
        }

        $scheduledCalls = DB::table('todo_scheduled_calls')
            ->where('contact_id', $id)
            ->orderBy('scheduled_date', 'desc')
            ->get();

        return view('Todo.log', compact('contact', 'scheduledCalls'));
    }
    
    // Show form to add contact
    public function create()
    {
        return view('contacts.create');
    }

    // Save contact
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'phone_number' => 'required|unique:todo_contacts,phone_number',
        ]);

        DB::table('todo_contacts')->insert([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully!');
    }

    // Delete contact
    public function destroy($id)
    {
        DB::table('todo_contacts')->where('id', $id)->delete();
        return back()->with('success', 'Contact deleted successfully!');
    }
}
