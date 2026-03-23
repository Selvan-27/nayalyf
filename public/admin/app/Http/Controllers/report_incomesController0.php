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
    
      if($income_type==="IGNITE"){
    //-------------START IGNITE -----------------
  
      return $data = DB::table('referral_income')
            ->join('users', 'users.memberid', '=', 'referral_income.fromId')
            //->where('re_ignite_income.memberid', $login_id)
            ->select(
                'users.name As name',
                'referral_income.*'
            )
            ->get();
            
    //-----------END IGNITE------------------- 
     }else if($income_type==="RE-IGNITE"){      
    //----------START RE-IGNITE ---------------
    
      $data = DB::table('re_ignite_income')
            ->join('users', 'users.memberid', '=', 're_ignite_income.fromId')
            ->select(
                 'users.name As name',
                're_ignite_income.*'
               
            )
            ->get();
            

    //----------END RE-IGNITE ---------------    
    }else if($income_type==="TEAM-PERFORMANCE"){      
    //----------START TEAM PERFORMANCE  ---------------   
    
     $data = DB::table('team_performance_income')
            ->join('users', 'users.memberid', '=', 'team_performance_income.fromId')
            ->select(
                'team_performance_income.*',
                'users.name As name'
            )
            ->get();
            
            
    }else if($income_type==="GLOBAL_INCOME"){      
    //----------START GLOBAL_INCOME  ---------------   
    
     $data = DB::table('global_bonus_income')
            ->join('users', 'users.memberid', '=', 'global_bonus_income.memberid')
            ->select(
                'global_bonus_income.*',
                'users.name As name'
            )
            ->get();

    }else if($income_type==="fast_track_income"){      
    //----------START GLOBAL_INCOME  ---------------   
    
     $data = DB::table('fast_track_income')
            ->join('users', 'users.memberid', '=', 'fast_track_income.memberid')
            ->select(
                'users.name As name',
                'fast_track_income.*'
                
            )
            ->get();

    }else if($income_type==="achievement_level_income"){      
    //----------START GLOBAL_INCOME  ---------------   
    
     $data = DB::table('achievement_level_income')
            ->join('users', 'users.memberid', '=', 'achievement_level_income.memberid')
            ->select(
                  'users.name As name',
                'achievement_level_income.*'
              
            )
            ->get();
            
            
    }else if($income_type==="repurchase_level_income"){      
    //----------START GLOBAL_INCOME  ---------------   
    
     $data = DB::table('repurchase_level_income')
            ->join('users', 'users.memberid', '=', 'repurchase_level_income.memberid')
            ->select(
                  'users.name As name',
                'repurchase_level_income.*'
              
            )
            ->get();        
   
    }else{
        
    }    

return view('reports', compact('data','income_type')); 
    
}


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
