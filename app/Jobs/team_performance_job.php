<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// include models
use App\Models\User;
use App\Models\team_performance_queue;
use App\Models\special_board_activation_queue;
use App\Models\mlm_plan;
use App\Models\roi_income;
use App\Models\referral_income;
use App\Models\board_user_income;
use App\Models\levelincome;



// include controllers
use App\Http\Controllers\Users\tree_traversal_controller;



class team_performance_job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        


        // Step 1: Fetch the latest activation_turn_id with pending and success status
$latestTurnId = team_performance_queue::where('status', 'success')
->where('activation_status', 'pending')
->whereNotNull('activation_turn_id') // Only consider rows where activation_turn_id is NOT NULL
->orderBy('id', 'desc') // Get the latest activation_turn_id by creation date
->value('activation_turn_id'); // Fetch only the latest activation_turn_id

// Step 2: Fetch the row to process
$team_performance_queue = team_performance_queue::where('status', 'success')
->where('activation_status', 'pending')
->when($latestTurnId, function ($query) use ($latestTurnId) {
    // Prioritize rows with the latest activation_turn_id
    return $query->where('activation_turn_id', $latestTurnId);
})
->orderBy('id', 'asc') // Process rows in ascending order of ID
->lockForUpdate()
->first();


// dd("enters here");

        if(!$team_performance_queue){
            return;
        }

        // if any row in the team_performance_queue table has activation_status as "faliure" then we need to process any row 

        $team_performance_queue_temp = team_performance_queue::where('activation_status', 'failed')->first();
        

        if(team_performance_queue::whereIn('activation_status', ['failed', 'processing'])->exists())
        {
            \Log::info('there is a failed row in team_performance_queue table'); 
            return; 
        }

        // if there is a row in the team_performance_queue table with activation_status as "failed" or "processing" then we shold not process any row

        if($team_performance_queue_temp)
        {
            \Log::info('there is a failed row in team_performance_queue table2'); 
            return; 
        }

        \Log::info('enters: 67 ');

        
      
 
        try {

            $board_id=$team_performance_queue->board;

                  // Mark as processing to avoid double-processing
                  $team_performance_queue->activation_status = 'processing';
                  $team_performance_queue->save();

                  \Log::info('input id: '.$team_performance_queue->activation_id);
            // Activate user

            $mlm_plan= mlm_plan::where('memberid', $team_performance_queue->activation_id)->first();

            $sponsor_id = $mlm_plan->sponsor_id;


      // if board id is greater than 0 then we need to insert the id to the board tables according to the board id . and also generate board incomes

            $top_id = mlm_plan::orderBy('id', 'asc')->first()->memberid;


            $model_name='board_'.$board_id;

            $board_model = $this->getModelInstance($model_name);

            $tree_traversal_controller = new tree_traversal_controller();

            // check if board_model has no recods 

            
    
           
            $placement_id = "top";
            $position = "top";
  
            if($team_performance_queue->activation_id == $top_id)
            {
                $placement_id = "top";
                $position = "top";
            }
            else
            {
                 
                // global search for placement id and position

                $placement_array = $tree_traversal_controller->findPlacementAndPosition($sponsor_id, $model_name);

                $placement_id = $placement_array['parentId'];
                $position = $placement_array['nextPos'];


                $full_global_search_res= $tree_traversal_controller->genealogy_list($model_name);
    

            }

    
            $board_model->memberid = $mlm_plan->memberid;
            $board_model->SponsorID = $mlm_plan->sponsor_id;
            $board_model->placement_id = $placement_id;
            $board_model->pos = $position;
            $board_model->save();



            $count_below_grand_parent_id=0;
            $count_below_great_great_grand_parent_id=0;
            $count_below_parent_id=0;
            $count_below_great_grand_parent_id=0;
            

            $parent_id=null;
            $grand_parent_id=null;
            $great_grand_parent_id=null;
            $great_great_grand_parent_id=null;

            
         
            if(strcmp($team_performance_queue->activation_id, $top_id) != 0 )
            {

                // correct family hierarchy start

                \Log::info('family hierarchy start');

                $parent = $board_model->where('memberid', $placement_id)->first();
                if (!empty($parent)) {
                    $parent_id = $parent->memberid;

                    $count_below_parent_id  =$tree_traversal_controller->countNodesBelow($parent_id,$model_name);

                    \Log::info('count_below_parent_id: '.$count_below_parent_id);

                    $mlm_plan_parent_id = mlm_plan::where('memberid', $parent_id)->first();
    
                    $users_parent_id = User::where('memberid', $parent_id)->first();

                }

                // correct family hierarchy end



            }

         

            $activation_turn_id= "at".mt_rand(10000000, 99999999);

            while(team_performance_queue::where('activation_turn_id', $activation_turn_id)->exists())
            {
              $activation_turn_id= "at".mt_rand(10000000, 99999999);
            }

            // if count equal to 6 generate engage income

            if($count_below_parent_id==3 and $board_id < 15){

                // dd("here");

                       // insert to plan activation queue for next board

                       $team_performance_queue_new = new team_performance_queue();
                       $team_performance_queue_new->login_id = $team_performance_queue->activation_id;
                       $team_performance_queue_new->activation_id = $parent_id;
                       $team_performance_queue_new->board = $board_id+1;
                       $team_performance_queue_new->activation_turn_id=$activation_turn_id;
                       $team_performance_queue_new->status = 'success';
                       $team_performance_queue_new->activation_status = 'pending';
                       $team_performance_queue_new->save();

                           // insert to plan activation queue for next board  end


            }
    


            // Mark the row as processed
            $team_performance_queue->activation_status = 'success';
            $team_performance_queue->save();


            // check if status is success

            // if status is success then we need to insert the next row to the team_performance_queue table



        } catch (\Exception $e) {
            // Handle failures
            $team_performance_queue->activation_status = 'failed';
            $team_performance_queue->save();

            \Log::error('Error processing queue item: ' . $team_performance_queue->id . ' - ' . $e->getMessage());
        }



    }


    public function failed(\Throwable $exception)
{
    // Mark the row as failed
    // $this->team_performance_queue->activation_status = 'failed';
    // $this->team_performance_queue->save();

    // \Log::error('Job failed for queue ID: ' . $this->team_performance_queue->id . '. Error: ' . $exception->getMessage());
}



public function generate_referral_income($mlm_plan,$ref_payout)
{

    // $referral_income_configurations= referral_income_configurations::where('id', 1)->first();


    $team_performance_queue_temp = team_performance_queue::where('activation_id',$mlm_plan->sponsor_id)->where('status', 'success')->first();

    if(!empty($team_performance_queue_temp))
    {
        $referral_income = new referral_income();
        $referral_income->memberid = $mlm_plan->sponsor_id;
        $referral_income->fromId = $mlm_plan->memberid;
        $referral_income->payout =$ref_payout;
        $referral_income->save();
    }
  



}

public function generate_board_referral_income($input_id,$ref_payout)
{

    $mlm_plan_temp= mlm_plan::where('memberid', $input_id)->first();

    // $referral_income_configurations= referral_income_configurations::where('id', 1)->first();
  
    $referral_income = new board_referral_income();
    $referral_income->memberid = $mlm_plan_temp->sponsor_id;
    $referral_income->fromId = $mlm_plan_temp->memberid;
    $referral_income->payout =$ref_payout;
    $referral_income->save();


}


public function generate_roi_income($input_id)
{

    // form the next day for 100 days need to add 1000 entries in roi_income table for the input id. payout will be 0.5.
    // increase date by 1 day for each entry
    $mlm_plan_temp = mlm_plan::where('memberid', $input_id)->first();
    $startDate = now();

    $startDate->format('Y-m-d');


    for ($i = 0; $i < 1000; $i++) {
        $roi_income = new roi_income();
        $roi_income->memberid = $mlm_plan_temp->memberid;
        $roi_income->payout = 0.5;
        $roi_income->netpay = 0.5;
        $roi_income->service_charge = 0;
        $roi_income->eligibility_date = $startDate->copy()->addDays($i);
        $roi_income->save();
    }

    

}

public function generate_levelincome($input_id)
{
    // \Log::info('input id in levelincome: '.$input_id);

    $referral_hierarchy = $this->get_referral_hierarchy_above($input_id);

    // generate levelincome for 10 levels above the input id. the payout will be same for every level.but the payout may vary if accourding to the number of referrals of the reciever. 

    $mlm_plan_temp = mlm_plan::where('memberid', $input_id)->first();

    $sponsor_id = $mlm_plan_temp->sponsor_id;

     $levelincome_payout=1;

   


    for($i=0;$i<10;$i++)
    {

        if(empty($referral_hierarchy[$i]))
        {
            break;
        }

        $levelincome_payout=1;

        $mlm_plan_temp2 = mlm_plan::where('memberid', $referral_hierarchy[$i])->first();

        if(empty($mlm_plan_temp2))
        break;

        if($this->get_number_of_referrals($referral_hierarchy[$i]) >= 3)
        {
           $levelincome_payout = 3;
        }
        
        if($this->get_number_of_referrals($referral_hierarchy[$i]) >= 5)
        {
           $levelincome_payout = 5;
        }

        // check if reciever is active 

        $team_performance_queue_temp = team_performance_queue::where('activation_id', $referral_hierarchy[$i])->where('status', 'success')->first();

        if(empty($team_performance_queue_temp))
        {
            continue;
        }
        
      

        $levelincome = new levelincome();
        $levelincome->memberid = $referral_hierarchy[$i];
        $levelincome->fromId = $input_id;
        $levelincome->payout = $levelincome_payout;
        $levelincome->netpay = $levelincome_payout;
        $levelincome->service_charge = 0;
        $levelincome->level = $i+1;
        $levelincome->save();

    }
   


}


public function get_number_of_referrals($input_id)
{

    \Log::info('input id: '.$input_id);

    $count = mlm_plan::where('mlm_plan.sponsor_id', $input_id)
    ->join('team_performance_queue', 'team_performance_queue.activation_id', '=', 'mlm_plan.memberid')
    ->where('team_performance_queue.activation_status', 'success')
    ->count();

    

    \Log::info('count: '.$count);

    return $count;
}

public function get_referral_hierarchy_above($input_id)
{
    $referral_hierarchy = array();
    $mlm_plan = mlm_plan::where('memberid', $input_id)->first();
    $sponsor_id = $mlm_plan->placement_id;
    $sponsor_id_temp = $sponsor_id;

    while (count($referral_hierarchy) < 10) {

        if (empty($sponsor_id_temp)) {
            break;
        }

        $mlm_plan_temp = mlm_plan::where('memberid', $sponsor_id_temp)->first();

        if (empty($mlm_plan_temp)) {
            break;
        }

        // Check if the sponsor is active
        $team_performance_queue_temp = team_performance_queue::where('activation_id', $sponsor_id_temp)
            ->where('status', 'success')
            ->first();

        if (!empty($team_performance_queue_temp)) {
            $referral_hierarchy[] = $sponsor_id_temp;
        }

        $sponsor_id_temp = $mlm_plan_temp->placement_id;
    }

    return $referral_hierarchy;
}


private function getModelInstance($modelName)
    {
        $modelClass = "App\\Models\\$modelName";

        if (class_exists($modelClass)) {
            return app($modelClass);
        }

        return null;
    }

    private function generate_unique_memberid()
    {

        $memberid = mt_rand(100000, 999999);

        $mlm_plan = mlm_plan::where('memberid', $memberid)->first();

        if($mlm_plan){
            $this->generate_unique_memberid();
        }

        return $memberid;
    }


public function get_board_user_income($board_id)
{
    
    $board_user_income = 0;

    if($board_id==1)
    {
        $board_user_income=10;

    }
else if($board_id==2)
{
    $board_user_income=25;
}
else if($board_id==3)
{
    $board_user_income=40;
}
else if($board_id==4)
{
    $board_user_income=80;
}
else if($board_id==5)
{
    $board_user_income=125;
}


    return $board_user_income;

}




}
