<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TaskController extends Controller
{
     public function index(Request $request)
    {
$filter = $request->get('status'); // optional ?status=Pending, etc.

$systemTasks = [
    ['id' => 1, 'title' => 'First 30 Contacts Inserted', 'description' => 'Initial import of 30 contacts', 'set' => 1],
    ['id' => 2, 'title' => 'Scheduled Call Update (1st Set)', 'description' => 'Update scheduled calls for 1st set (contacts 1–3)', 'set' => 1],
    ['id' => 3, 'title' => 'Scheduled Call Update (2nd Set)', 'description' => 'Update scheduled calls for 2nd set (contacts 4–6)', 'set' => 2],
    ['id' => 4, 'title' => 'Scheduled Call Update (3rd Set)', 'description' => 'Update scheduled calls for 3rd set (contacts 7–9)', 'set' => 3],
    ['id' => 5, 'title' => 'Scheduled Call Update (4th Set)', 'description' => 'Update scheduled calls for 4th set (contacts 10–12)', 'set' => 4],
    ['id' => 6, 'title' => 'Scheduled Call Update (5th Set)', 'description' => 'Update scheduled calls for 5th set (contacts 13–15)', 'set' => 5],
    ['id' => 7, 'title' => 'Review Call (1st & 2nd Set)', 'description' => 'Follow-up for 1st & 2nd sets', 'set' => [1, 2]],
    ['id' => 8, 'title' => 'Review Call (3rd, 4th & 5th Set)', 'description' => 'Review calls for 3rd–5th sets', 'set' => [3, 4, 5]],
];

$taskData = [];
$statusCount = ['Pending' => 0, 'In Progress' => 0, 'Completed' => 0];

foreach ($systemTasks as $task) {
    $contacts = collect();

    $completedCalls_total=0;
    // 🔹 1. First Task → 30 contacts directly from todo_contacts
    if ($task['id'] === 1) {
        $contacts = DB::table('todo_contacts')
            ->select('id', 'name', 'phone_number')
            ->orderBy('created_at', 'asc')
            ->limit(30)
            ->get();

        // No scheduled calls for this task
        $calls = collect();
        $progress = $contacts->count() > 0 ? 100 : 0; // assume inserted = done
        $status = 'Completed';
    } else {
        // 🔹 Other Tasks → Get sets of contacts
        if ($task['set']) {
            $sets = is_array($task['set']) ? $task['set'] : [$task['set']];
            foreach ($sets as $setNo) {
                $offset = ($setNo - 1) * 3;
                $contacts = $contacts->merge(
                    DB::table('todo_contacts')
                        ->offset($offset)
                        ->limit(3)
                        ->get()
                    
                    // DB::table('todo_scheduled_calls as s') ->join('todo_contacts as c', 's.contact_id', '=', 'c.id') ->select('s.*', 'c.name', 'c.phone_number') ->whereRaw('s.scheduled_date = ( SELECT MIN(s2.scheduled_date) FROM todo_scheduled_calls as s2 WHERE s2.contact_id = s.contact_id )') ->orderBy('s.created_at', 'asc') ->offset($offset)->limit(3)->get()
                    
                );
            }
        }

        // 🔹 Fetch scheduled calls for these contacts
        $calls = DB::table('todo_scheduled_calls as s')
            ->join('todo_contacts as c', 's.contact_id', '=', 'c.id')
            ->whereIn('s.contact_id', $contacts->pluck('id'))
            ->select('s.*', 'c.name', 'c.phone_number')
            ->get();
    
        // 🔹 Determine total & completed calls
            $totalCalls = $calls->count();
            $completedCalls = 0; // reset for each task

        // 🔹 2. Scheduled Call Update logic
        if (Str::contains($task['title'], 'Scheduled Call Update')) {
            // Only consider 1 call as minimum completion

        }
        // 🔹 3. Review Call logic
        elseif (Str::contains($task['title'], 'Review Call')) {
            // Only consider 2 calls as minimum completion

        }
        // 🔹 Other tasks (count all)
        else {
   
        }
        
      $totalCalls = $calls->count();
$completedCalls = $calls->where('status', 'Completed')->count(); // reset every task!

// Optionally store per-task sums
$taskCompletedSum = $completedCalls;
$taskTotalSum = $totalCalls;

// Compute progress per task (not cumulative)
$progress = $taskTotalSum > 0 ? round(($taskCompletedSum / $taskTotalSum) * 100) : 0;

        if ($progress == 0) $status = 'Pending';
        elseif ($progress < 100) $status = 'In Progress';
        else $status = 'Completed';
    }

    $statusCount[$status]++;

    // Apply filter if present
    if ($filter && $filter !== $status) continue;

    $taskData[] = [
        'task' => (object) $task,
        'contacts' => $contacts,
        'calls' => $calls,
        'progress' => $progress,
        'status' => $status,
    ];
}


        // return $taskData;

        return view('Todo.tasks.index', compact('taskData', 'statusCount', 'filter'));
    }
    public function index1()
    {
        $systemTasks = [
            ['id' => 1, 'title' => 'First 30 Contacts Inserted', 'description' => 'Initial import of 30 contacts', 'set' => null],
            ['id' => 2, 'title' => 'Scheduled Call Update (2nd Set)', 'description' => 'Update scheduled calls for 2nd set (contacts 4–6)', 'set' => 2],
            ['id' => 3, 'title' => 'Scheduled Call Update (3rd Set)', 'description' => 'Update scheduled calls for 3rd set (contacts 7–9)', 'set' => 3],
            ['id' => 4, 'title' => 'Scheduled Call Update (4th Set)', 'description' => 'Update scheduled calls for 4th set (contacts 10–12)', 'set' => 4],
            ['id' => 5, 'title' => 'Scheduled Call Update (5th Set)', 'description' => 'Update scheduled calls for 5th set (contacts 13–15)', 'set' => 5],
            ['id' => 6, 'title' => 'Review Call (1st & 2nd Set)', 'description' => 'Follow up for 1st & 2nd sets', 'set' => [1,2]],
            ['id' => 7, 'title' => 'Review Call (3rd, 4th & 5th Set)', 'description' => 'Review calls for 3rd–5th sets', 'set' => [3,4,5]],
            ['id' => 8, 'title' => 'Update 1st 3 Core Contacts (6th Set)', 'description' => 'App update for 6th set', 'set' => 6],
            ['id' => 9, 'title' => 'Update Next 3 Core Contacts (7th Set)', 'description' => 'App update for 7th set', 'set' => 7],
            ['id' => 10, 'title' => 'Update Next 3 Core Contacts (8th Set)', 'description' => 'App update for 8th set', 'set' => 8],
        ];

        $taskData = [];

        foreach ($systemTasks as $task) {
            $contacts = collect();
            if ($task['set']) {
                $sets = is_array($task['set']) ? $task['set'] : [$task['set']];
                foreach ($sets as $setNo) {
                    $offset = ($setNo - 1) * 3;
                    $contacts = $contacts->merge(
                        DB::table('todo_contacts')->offset($offset)->limit(3)->get()
                    );
                }
            }

            $calls = DB::table('todo_scheduled_calls as s')
                ->join('todo_contacts as c', 's.contact_id', '=', 'c.id')
                ->whereIn('s.contact_id', $contacts->pluck('id'))
                ->select('s.*', 'c.name', 'c.phone_number')
                ->orderBy('scheduled_date', 'asc')
                ->get();

            // 🔹 Calculate task progress
            $totalCalls = $calls->count();
            $completedCalls = $calls->where('status', 'Completed')->count();
            $progress = $totalCalls > 0 ? round(($completedCalls / $totalCalls) * 100) : 0;

            // 🔹 Determine task status
            if ($progress == 0) {
                $status = 'Pending';
            } elseif ($progress < 100) {
                $status = 'In Progress';
            } else {
                $status = 'Completed';
            }

            $taskData[] = [
                'task' => (object) $task,
                'contacts' => $contacts,
                'calls' => $calls,
                'progress' => $progress,
                'status' => $status,
            ];
        }
            return $taskData;
        return view('task.index', compact('taskData'));
    }
    public function index2()
    {
        // Get all tasks
        $tasks = DB::table('todo_tasks')->groupBy('task_id')->select('task_id')->get();

        // Preload task-related contacts and scheduled calls
        $taskData = [];

        foreach ($tasks as $task) {
            $contacts = DB::table('todo_tasks as tc')
                ->join('todo_contacts as c', 'tc.contact_id', '=', 'c.id')
                ->where('tc.task_id', $task->task_id)
                ->select('c.id', 'c.name', 'c.phone_number', 'c.status')
                ->get();
    //    return $contacts->pluck('contact_id');
            $calls = DB::table('todo_scheduled_calls as s')
                ->join('todo_contacts as c', 's.contact_id', '=', 'c.id')
                ->whereIn('s.contact_id', $contacts->pluck('id'))
                ->select('s.*', 'c.name', 'c.phone_number')
                ->orderBy('scheduled_date', 'asc')
                ->get();

            $taskData[] = [
                'task' => $task,
                'contacts' => $contacts,
                'calls' => $calls
            ];
        }

        return $taskData;
        return view('task.index', compact('taskData'));
    }
}
