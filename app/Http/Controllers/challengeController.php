<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\daily_challenge;
use App\Models\Product;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class challengeController extends Controller
{
    
    
     public function start(Request $request)
    {
        $login_id = Auth::user()->memberid;  
        
      $tag=$request->Challenge;
        
        if($tag){
            
        $products=Product::where('type','products')->where('is_active',1)->where('tag',$tag)->get();
        }else{
               $products=Product::where('type','products')->where('is_active',1)->where('category_id',29)->get();
             }
     return view('challenge.start',compact('login_id','products'));   
    }    
    
    public function index()
    {
        $login_id = Auth::user()->memberid;  
         
        $datas = daily_challenge::where('user_id', $login_id)
            // ->whereDate('workflow_date', Carbon::today())
            ->get();
            
            
         $mrg = daily_challenge::where('user_id', $login_id)->where('morning_opened', 1)->count();
         $nit = daily_challenge::where('user_id', $login_id)->where('night_opened', 1)->count();
            
        $tot_count=$mrg+$nit;
            
            $today = Carbon::today();
          $startDate = Carbon::now()->startOfMonth();

    $data = daily_challenge::where('user_id', $login_id)
        ->whereDate('workflow_date', '>=', $startDate)
        ->orderBy('workflow_date', 'asc')
        ->get()
        ->keyBy(function ($item) {
            return Carbon::parse($item->workflow_date)->format('Y-m-d');
        });

$week = collect();

$current = $startDate->copy();
while ($current->lte($today)) {
    $formatted = $current->format('Y-m-d');

    $week->push([
        'date' => $current->copy(),
        'data' => $data[$formatted] ?? null
    ]);

    $current->addDay();
}


 
        return view('challenge.index',compact('week','datas','tot_count'));   
    }
    
    private function getTodayRow()
    {
        return daily_challenge::firstOrCreate(
            [
                'user_id' => Auth::user()->memberid,
                'workflow_date' => Carbon::today(),
            ],
            [
                'morning_opened' => false,
                'night_opened' => false,
            ]
        );
    }

    /**
     * Morning button click
     */
    public function morningOpen()
    {
        $workflow = $this->getTodayRow();

        if (!$workflow->morning_opened) {
            $workflow->update([
                'morning_opened' => true,
                'morning_opened_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Morning status updated',
            'data' => $workflow
        ]);
    }

    /**
     * Night button click
     */
    public function nightOpen()
    {
        $workflow = $this->getTodayRow();

        if (!$workflow->night_opened) {
            $workflow->update([
                'night_opened' => true,
                'night_opened_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Night status updated',
            'data' => $workflow
        ]);
    }

    /**
     * Get today's status
     */

}