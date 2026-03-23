<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class report_incomesController extends Controller
{

public function reports(Request $request){ 
    $income_type=$request->type;
    $data=[];
                 $board=$request->board;
    if(!$board){
        $board=1;
    }
      if($income_type==="IGNITE"){
    //-------------START IGNITE -----------------
    
    
      $data = DB::table('referral_income')
        ->join('users as from_user', 'from_user.memberid', '=', 'referral_income.fromId')
        ->join('users as to_user', 'to_user.memberid', '=', 'referral_income.memberid')
        ->select(
            'from_user.name as fname',   // Referrer name
            'from_user.profile_photo as fphoto',   // Referrer name
            
            'to_user.name as tname',     // Receiver name
            'to_user.profile_photo as tphoto',     // Receiver name
            'referral_income.*'
        )
        ->get();

            
        return view('income.refinlist', compact('data','income_type'));     
            
    //-----------END IGNITE------------------- 
     }else if($income_type==="RE-IGNITE"){      
    //----------START RE-IGNITE ---------------

            
              $data = DB::table('re_ignite_income')
        ->join('users as from_user', 'from_user.memberid', '=', 're_ignite_income.fromId')
        ->join('users as to_user', 'to_user.memberid', '=', 're_ignite_income.memberid')
        ->select(
            'from_user.name as fname',   // Referrer name
            'from_user.profile_photo as fphoto',   // Referrer name
            
            'to_user.name as tname',     // Receiver name
            'to_user.profile_photo as tphoto',     // Receiver name
            're_ignite_income.*'
        )
        ->get();
        
            
  return view('income.refinlist', compact('data','income_type'));     
    //----------END RE-IGNITE ---------------    
    }else if($income_type==="TEAM-PERFORMANCE"){      
    //----------START TEAM PERFORMANCE  ---------------   
     $board=$request->board;
    if(!$board){
        $board=1;
    }
      $data = DB::table('team_performance_income')
        ->join('users as from_user', 'from_user.memberid', '=', 'team_performance_income.fromId')
        ->join('users as to_user', 'to_user.memberid', '=', 'team_performance_income.memberid')
        ->where('team_performance_income.tree_number',$board)
        ->where('team_performance_income.ignored',0)
        ->select(
            'from_user.name as fname',   // Referrer name
            'from_user.profile_photo as fphoto',   // Referrer name
            
            'to_user.name as tname',     // Receiver name
            'to_user.profile_photo as tphoto',     // Receiver name
            'team_performance_income.*'
        )
        ->get();
            
     return view('income.team_performance_income', compact('data','income_type'));     
     
    }else if($income_type==="GLOBAL_INCOME"){      
    //----------START GLOBAL_INCOME  ---------------   


            $data = DB::table('global_bonus_income')
        ->join('mlm_plan as from_user', 'from_user.memberid', '=', 'global_bonus_income.fromId')
        ->join('mlm_plan as to_user', 'to_user.memberid', '=', 'global_bonus_income.memberid')
        ->where('global_bonus_income.tree_number',$board)
        ->where('global_bonus_income.ignored',0)
        ->select(
            'from_user.FullName as fname',   // Referrer name
            
            'to_user.FullName as tname',     // Receiver name
            'global_bonus_income.*'
        )
        ->get();

     return view('income.global_bonus_income', compact('data','income_type'));  

    }else if($income_type==="fast_track_income"){      
    //----------START GLOBAL_INCOME  ---------------   
    
     $data = DB::table('fast_track_income')
        // ->join('users as from_user', 'from_user.memberid', '=', 'fast_track_income.fromId')
        ->join('users as to_user', 'to_user.memberid', '=', 'fast_track_income.memberid')
        ->where('fast_track_income.tree_number',$board)
        // ->where('fast_track_income.ignored',0)
        ->select(
            // 'from_user.name as fname',   // Referrer name
            // 'from_user.profile_photo as fphoto',   // Referrer name
            'to_user.name as tname',     // Receiver name
            'to_user.profile_photo as tphoto',     // Receiver name
            'fast_track_income.*'
        )->get();
            
         return view('income.fast_track_income', compact('data','income_type'));       
            

    }else if($income_type==="achievement_level_income"){      
    //----------START GLOBAL_INCOME  ---------------   
    
    
      $data = DB::table('achievement_level_income')
        ->join('users as from_user', 'from_user.memberid', '=', 'achievement_level_income.fromId')
        ->join('users as to_user', 'to_user.memberid', '=', 'achievement_level_income.memberid')
        // ->where('achievement_level_income.tree_number',$board)
        // ->where('fast_track_income.ignored',0)
        ->select(
            'from_user.name as fname',   // Referrer name
            'from_user.profile_photo as fphoto',   // Referrer name
            'to_user.name as tname',     // Receiver name
            'to_user.profile_photo as tphoto',     // Receiver name
            'achievement_level_income.*'
        )->get();
    
    return view('income.achievement_level_income', compact('data','income_type'));             
            
    }else if($income_type==="repurchase_level_income"){      
    //----------START REPURCHASE LEVEL INCOME  ---------------   
        $slot = $request->slot;
        $repurchase_cutoff_slots = DB::table('repurchase_cutoff_slots')->get(); 
        
        $data = [];
        
        if($slot) {
            // Get the selected cutoff slot details
            $selected_slot = DB::table('repurchase_cutoff_slots')->where('id', $slot)->first();
            
            // Get all members who have repurchase level income for this slot
            $members = DB::table('repurchase_level_income')
                ->join('users', 'users.memberid', '=', 'repurchase_level_income.memberid')
                ->where('repurchase_level_income.cutoff_slot_id', $slot)
                ->select('users.memberid', 'users.name', 'users.profile_photo')
                ->distinct()
                ->get();
            
            foreach($members as $member) {
                // Get income for each level (1-14) for this member
                $level_incomes = [];
                $total_bonus = 0;
                
                for($level = 1; $level <= 14; $level++) {
                    $income = DB::table('repurchase_level_income')
                        ->where('memberid', $member->memberid)
                        ->where('cutoff_slot_id', $slot)
                        ->where('level', $level)
                        ->sum('payout');
                    
                    $count = DB::table('repurchase_level_income')
                        ->where('memberid', $member->memberid)
                        ->where('cutoff_slot_id', $slot)
                        ->where('level', $level)
                        ->count();
                    
                    $level_incomes[$level] = [
                        'amount' => $income,
                        'count' => $count
                    ];
                    
                    $total_bonus += $income;
                }
                
                $data[] = [
                    'member' => $member,
                    'cutoff_slot' => $selected_slot,
                    'level_incomes' => $level_incomes,
                    'total_bonus' => $total_bonus
                ];
            }
        }
        
        return view('income.repurchase_level_income', compact('data', 'repurchase_cutoff_slots', 'income_type')); 
   
    }else if($income_type==="repurchase_level_income2"){      
    //----------START GLOBAL_INCOME  ---------------   
         $slot=$request->slot;
      $repurchase_cutoff_slots = DB::table('repurchase_cutoff_slots')->get(); 
            
              $data = DB::table('repurchase_level_income')
        // ->join('users as from_user', 'from_user.memberid', '=', 'repurchase_level_income.fromId')
        ->join('users as to_user', 'to_user.memberid', '=', 'repurchase_level_income.memberid')
        // ->where('repurchase_level_income.cutoff_slot_id',$slot)
        // ->where('repurchase_level_income.ignored',0)
        ->select(
            // 'from_user.name as fname',   // Referrer name
            // 'from_user.profile_photo as fphoto',   // Referrer name
            'to_user.name as tname',     // Receiver name
            'to_user.profile_photo as tphoto',     // Receiver name
            'repurchase_level_income.*'
        )->get();
   
   return view('income.repurchase_level_income2', compact('data','repurchase_cutoff_slots','income_type')); 
 
    }else{
        
    }    


    
}

public function incentive(){ $data = []; return view('incentive', compact('data')); }
public function reignite_list(){ $data = []; return view('rbinlist', compact('data')); }
public function team_performance_list(){ $data = []; return view('tpinlist', compact('data')); }
public function global_list(){ $data = []; return view('ginlist', compact('data')); }
public function fasttrack_list(){ $data = []; return view('ftinlist', compact('data')); }
public function achievement_list(){ $data = []; return view('ainlist', compact('data')); }
public function repurchase_list(){ $data = []; return view('rlinlist', compact('data')); }

public function team_tree(){ $data = []; return view('treeown', compact('data')); }
public function team_per_tree(){ $data = []; return view('treeteam', compact('data')); }
public function global_tree(){ $data = []; return view('treeglobal', compact('data')); }
public function fast_track_tree(){ $data = []; return view('treefast', compact('data')); }
public function achievement_tree(){ $data = []; return view('treeachieve', compact('data')); }
public function repurchase_tree(){ $data = []; return view('treerepur', compact('data')); }



}
