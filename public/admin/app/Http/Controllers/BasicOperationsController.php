<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BasicOperationsController extends Controller
{
    /**
     * Display the incentive fix page with existing data
     */
    public function incentiveFix()
    {
        // Fetch existing incentive configurations
        $data = DB::table('unique_incentive_income_configurations')
                  ->where('status', 1)
                  ->orderBy('created_at', 'desc')
                  ->get();

        return view('incentive_fix', compact('data'));
    }

    /**
     * Store a new incentive percentage configuration
     */
    public function storeIncentivePercentage(Request $request)
    {
        // Validate the input
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        try {
            // Insert new record into the database
            DB::table('unique_incentive_income_configurations')->insert([
                'percentage' => $request->percentage,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Incentive percentage fixed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fix incentive percentage. Please try again.');
        }
    }

    /**
     * Update an existing incentive percentage configuration
     */
    public function updateIncentivePercentage(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        try {
            // Update the record
            DB::table('unique_incentive_income_configurations')
              ->where('id', $id)
              ->update([
                  'percentage' => $request->percentage,
                  'updated_at' => Carbon::now()
              ]);

            return redirect()->back()->with('success', 'Incentive percentage updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update incentive percentage. Please try again.');
        }
    }

    /**
     * Delete/deactivate an incentive percentage configuration
     */
    public function deleteIncentivePercentage($id)
    {
        try {
            // Set status to 0 instead of deleting
            DB::table('unique_incentive_income_configurations')
              ->where('id', $id)
              ->update([
                  'status' => 0,
                  'updated_at' => Carbon::now()
              ]);

            return redirect()->back()->with('success', 'Incentive percentage deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete incentive percentage. Please try again.');
        }
    }
}