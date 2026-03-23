<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\mlm_plan;
use App\Models\plan_activation_queue;
use App\Models\repurchase_cutoff_slots;
use App\Models\awards_and_rewards_cutoff_slots;
use App\Models\ecom_orders;
use Carbon\Carbon;

class CutoffTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🌱 Seeding cutoff test data...');

        // Create test scenarios
        $this->createTestMembers();
        $this->createTestCutoffSlots();
        $this->createTestEcomOrders();
        $this->createTestRepurchases();

        $this->command->info('✅ Cutoff test data seeding completed');
    }

    /**
     * Create test members with hierarchy
     */
    private function createTestMembers()
    {
        $this->command->info('👥 Creating test members...');

        // Root member
        $rootMember = $this->createMember([
            'memberid' => 'TEST001',
            'sponsor_id' => null,
            'FullName' => 'Root Test Member',
            'status' => 1,
        ]);

        // Level 1 members (direct referrals)
        $level1Members = [];
        for ($i = 1; $i <= 5; $i++) {
            $member = $this->createMember([
                'memberid' => "TEST1{$i:02d}",
                'sponsor_id' => 'TEST001',
                'FullName' => "Level 1 Member {$i}",
                'status' => 1,
            ]);
            $level1Members[] = $member->memberid;
        }

        // Level 2 members
        $level2Members = [];
        foreach ($level1Members as $index => $parentId) {
            for ($i = 1; $i <= 3; $i++) {
                $memberId = "TEST2{$index}{$i}";
                $member = $this->createMember([
                    'memberid' => $memberId,
                    'sponsor_id' => $parentId,
                    'FullName' => "Level 2 Member {$index}-{$i}",
                    'status' => 1,
                ]);
                $level2Members[] = $member->memberid;
            }
        }

        // Level 3 members (for leaders level income testing)
        foreach ($level2Members as $index => $parentId) {
            for ($i = 1; $i <= 2; $i++) {
                $memberId = "TEST3{$index}{$i}";
                $this->createMember([
                    'memberid' => $memberId,
                    'sponsor_id' => $parentId,
                    'FullName' => "Level 3 Member {$index}-{$i}",
                    'status' => 1,
                ]);
            }
        }

        $this->command->info('   ✅ Created hierarchical test members');
    }

    /**
     * Create a single member with activation queue entry
     */
    private function createMember($data)
    {
        $member = mlm_plan::create(array_merge([
            'placement_id' => $data['sponsor_id'] ?? null,
            'original_id' => $data['sponsor_id'] ?? $data['memberid'],
            'all_father_id' => $data['sponsor_id'] ?? $data['memberid'],
            'referral_count' => 0,
            'memberid_type' => 'regular',
            'rank' => 'UCWC DISTRIBUTOR',
            'created_at' => now()->subDays(rand(30, 90)),
        ], $data));

        // Add to activation queue
        plan_activation_queue::create([
            'login_id' => $member->memberid,
            'activation_id' => $member->memberid,
            'parent_activation_id' => null,
            'activation_status' => 'success',
            'status' => 'success',
            'created_at' => $member->created_at,
        ]);

        return $member;
    }

    /**
     * Create test cutoff slots
     */
    private function createTestCutoffSlots()
    {
        $this->command->info('📅 Creating test cutoff slots...');

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $tomorrow = Carbon::tomorrow();

        // Repurchase cutoff slots
        repurchase_cutoff_slots::create([
            'name' => 'Test Repurchase Slot - Yesterday',
            'from_date' => $yesterday->format('Y-m-d'),
            'to_date' => $yesterday->format('Y-m-d'),
            'status' => 'success',
            'created_at' => $yesterday,
        ]);

        repurchase_cutoff_slots::create([
            'name' => 'Test Repurchase Slot - Today',
            'from_date' => $today->format('Y-m-d'),
            'to_date' => $today->format('Y-m-d'),
            'status' => 'pending',
            'created_at' => $today,
        ]);

        repurchase_cutoff_slots::create([
            'name' => 'Test Repurchase Slot - Tomorrow',
            'from_date' => $tomorrow->format('Y-m-d'),
            'to_date' => $tomorrow->format('Y-m-d'),
            'status' => 'pending',
            'created_at' => $today,
        ]);

        // Awards cutoff slots
        awards_and_rewards_cutoff_slots::create([
            'name' => 'Test Awards Slot - Yesterday',
            'from_date' => $yesterday->format('Y-m-d'),
            'to_date' => $yesterday->format('Y-m-d'),
            'status' => 'success',
            'created_at' => $yesterday,
        ]);

        awards_and_rewards_cutoff_slots::create([
            'name' => 'Test Awards Slot - Today',
            'from_date' => $today->format('Y-m-d'),
            'to_date' => $today->format('Y-m-d'),
            'status' => 'pending',
            'created_at' => $today,
        ]);

        $this->command->info('   ✅ Created test cutoff slots');
    }

    /**
     * Create test ecom orders
     */
    private function createTestEcomOrders()
    {
        $this->command->info('🛒 Creating test ecom orders...');

        $testMembers = mlm_plan::where('memberid', 'like', 'TEST%')->get();
        $today = Carbon::today();

        foreach ($testMembers->take(10) as $member) {
            // Create orders for today's cutoff
            for ($i = 1; $i <= rand(1, 3); $i++) {
                ecom_orders::create([
                    'user_id' => $member->memberid,
                    'order_id' => 'ORD_' . $member->memberid . '_' . $i,
                    'total' => rand(500, 2000),
                    'PV' => rand(400, 1600),
                    'status' => 'delivered',
                    'created_at' => $today->copy()->addHours(rand(1, 20)),
                ]);
            }

            // Create orders for yesterday
            for ($i = 1; $i <= rand(0, 2); $i++) {
                ecom_orders::create([
                    'user_id' => $member->memberid,
                    'order_id' => 'ORD_' . $member->memberid . '_Y_' . $i,
                    'total' => rand(500, 2000),
                    'PV' => rand(400, 1600),
                    'status' => 'delivered',
                    'created_at' => Carbon::yesterday()->addHours(rand(1, 20)),
                ]);
            }
        }

        $this->command->info('   ✅ Created test ecom orders');
    }

    /**
     * Create test repurchases
     */
    private function createTestRepurchases()
    {
        $this->command->info('🔄 Creating test repurchases...');

        $testMembers = mlm_plan::where('memberid', 'like', 'TEST%')->get();

        foreach ($testMembers->take(8) as $member) {
            // Create 1-3 repurchases for each member
            for ($i = 1; $i <= rand(1, 3); $i++) {
                $repurchaseId = "RP" . mt_rand(100000, 999999);
                
                // Create repurchase entry
                $repurchase = mlm_plan::create([
                    'memberid' => $repurchaseId,
                    'sponsor_id' => $member->memberid,
                    'placement_id' => $member->memberid,
                    'original_id' => $member->memberid,
                    'all_father_id' => $member->memberid,
                    'referral_count' => 0,
                    'memberid_type' => 'repurchase',
                    'status' => 1,
                    'created_at' => Carbon::today()->addHours(rand(1, 20)),
                ]);

                // Add to activation queue
                plan_activation_queue::create([
                    'login_id' => $member->memberid,
                    'activation_id' => $repurchaseId,
                    'parent_activation_id' => null,
                    'activation_status' => 'success',
                    'status' => 'success',
                    'created_at' => $repurchase->created_at,
                ]);
            }
        }

        $this->command->info('   ✅ Created test repurchases');
    }

    /**
     * Clean up test data
     */
    public function cleanup()
    {
        $this->command->info('🧹 Cleaning up test data...');

        // Delete test records
        mlm_plan::where('memberid', 'like', 'TEST%')->delete();
        mlm_plan::where('memberid', 'like', 'RP%')->delete();
        plan_activation_queue::where('login_id', 'like', 'TEST%')->delete();
        ecom_orders::where('user_id', 'like', 'TEST%')->delete();
        
        // Delete test cutoff slots
        repurchase_cutoff_slots::where('name', 'like', 'Test%')->delete();
        awards_and_rewards_cutoff_slots::where('name', 'like', 'Test%')->delete();

        $this->command->info('   ✅ Test data cleaned up');
    }
}