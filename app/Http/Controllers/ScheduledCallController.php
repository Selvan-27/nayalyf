<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduledCallController extends Controller
{
    public function index()
    {
         $scheduledCalls = DB::table('todo_scheduled_calls as s')
            ->join('todo_contacts as c', 's.contact_id', '=', 'c.id')
            ->where('s.status','!=', 'Completed')
            ->select('s.*', 'c.name', 'c.phone_number')
            
            ->orderBy('scheduled_date', 'asc')
            ->get();

        return view('Todo.scheduled.index', compact('scheduledCalls'));
    }

    public function create()
    {
        $contacts = DB::table('todo_contacts')->where('status', 'Active')->get();
        return view('Todo.scheduled.create', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:todo_contacts,id',
            'scheduled_date' => 'required|date'
        ]);

        DB::table('todo_scheduled_calls')->insert([
            'contact_id' => $request->contact_id,
            'scheduled_date' => $request->scheduled_date,
            'notes' => $request->notes ?? null,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('scheduled.index')->with('success', 'Call scheduled successfully!');
    }

    // ✏️ Edit existing schedule
    public function edit($id)
    {
        $call = DB::table('todo_scheduled_calls')->where('id', $id)->first();
        $contacts = DB::table('todo_contacts')->where('status', 'Active')->get();

        if (!$call) {
            return redirect()->route('scheduled.index')->with('error', 'Scheduled call not found.');
        }

        return view('Todo.scheduled.edit', compact('call', 'contacts'));
    }

    // 💾 Update schedule or notes
    public function update(Request $request, $id)
    {
        $request->validate([
            'contact_id' => 'required|exists:todo_contacts,id',
            'scheduled_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        DB::table('todo_scheduled_calls')->where('id', $id)->update([
            'contact_id' => $request->contact_id,
            'scheduled_date' => $request->scheduled_date,
             'status' => 'Completed',
            'updated_at' => now()
        ]);
        
        
          DB::table('todo_scheduled_calls')->insert([
            'contact_id' => $request->contact_id,
            'scheduled_date' => $request->scheduled_date,
            'notes' => $request->notes ?? null,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('scheduled.index')->with('success', 'Scheduled call updated successfully!');
    }
}
