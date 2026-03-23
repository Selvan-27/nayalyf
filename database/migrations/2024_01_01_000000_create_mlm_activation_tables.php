<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Plan activation queue table
        if (!Schema::hasTable('plan_activation_queue')) {
            Schema::create('plan_activation_queue', function (Blueprint $table) {
                $table->id();
                $table->string('activation_id');
                $table->enum('activation_status', ['pending', 'processing', 'success', 'failed'])->default('pending');
                $table->timestamps();
                
                $table->index('activation_id');
                $table->index('activation_status');
            });
        }

        // MLM plan table
        if (!Schema::hasTable('mlm_plan')) {
            Schema::create('mlm_plan', function (Blueprint $table) {
                $table->id();
                $table->string('memberid')->unique();
                $table->string('sponsor_id')->nullable();
                $table->string('placement_id')->nullable();
                $table->integer('referral_count')->default(0);
                $table->enum('memberid_type', ['regular', 'rebirth', 'fast_track_rebirth'])->default('regular');
                $table->string('original_id')->nullable(); // For rebirth tracking
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
                
                $table->index('sponsor_id');
                $table->index('placement_id');
                $table->index('original_id');
                $table->index('status');
            });
        }

        // Team performance tree
        if (!Schema::hasTable('team_performance_tree')) {
            Schema::create('team_performance_tree', function (Blueprint $table) {
                $table->id();
                $table->string('memberid');
                $table->string('sponsorid')->nullable();
                $table->string('placement_id')->nullable();
                $table->string('pos', 10)->nullable();
                $table->integer('tree_no')->default(1);
                $table->timestamps();
                
                $table->index(['memberid', 'tree_no']);
                $table->index(['placement_id', 'tree_no']);
            });
        }

        // Global tree
        if (!Schema::hasTable('global_tree')) {
            Schema::create('global_tree', function (Blueprint $table) {
                $table->id();
                $table->string('memberid');
                $table->string('sponsorid')->nullable();
                $table->string('placement_id')->nullable();
                $table->string('pos', 10)->nullable();
                $table->integer('tree_no')->default(1);
                $table->timestamps();
                
                $table->index(['memberid', 'tree_no']);
                $table->index(['placement_id', 'tree_no']);
            });
        }

        // Achievement tree
        if (!Schema::hasTable('achievement_tree')) {
            Schema::create('achievement_tree', function (Blueprint $table) {
                $table->id();
                $table->string('memberid');
                $table->string('sponsorid')->nullable();
                $table->string('placement_id')->nullable();
                $table->string('pos', 10)->nullable();
                $table->integer('tree_no')->default(1);
                $table->timestamps();
                
                $table->index(['memberid', 'tree_no']);
                $table->index(['placement_id', 'tree_no']);
            });
        }

        // Fast track tree
        if (!Schema::hasTable('fast_track_tree')) {
            Schema::create('fast_track_tree', function (Blueprint $table) {
                $table->id();
                $table->string('memberid');
                $table->string('sponsorid')->nullable();
                $table->string('placement_id')->nullable();
                $table->string('pos', 10)->nullable();
                $table->integer('tree_no')->default(1);
                $table->timestamps();
                
                $table->index(['memberid', 'tree_no']);
                $table->index(['placement_id', 'tree_no']);
            });
        }

        // Re-ignite income table
        if (!Schema::hasTable('re_ignite_income')) {
            Schema::create('re_ignite_income', function (Blueprint $table) {
                $table->id();
                $table->string('original_id');
                $table->string('rebirth_id');
                $table->decimal('amount', 10, 2)->default(160);
                $table->timestamps();
                
                $table->index('original_id');
                $table->index('rebirth_id');
            });
        }

        // Team performance income table
        if (!Schema::hasTable('team_performance_income')) {
            Schema::create('team_performance_income', function (Blueprint $table) {
                $table->id();
                $table->string('beneficiary_id');
                $table->string('trigger_node_id');
                $table->string('reference_node_id');
                $table->integer('position_in_cycle');
                $table->integer('tree_number');
                $table->decimal('amount', 10, 2);
                $table->timestamps();
                
                $table->index('beneficiary_id');
                $table->index('trigger_node_id');
                $table->index(['tree_number', 'position_in_cycle']);
            });
        }

        // Global bonus income table
        if (!Schema::hasTable('global_bonus_income')) {
            Schema::create('global_bonus_income', function (Blueprint $table) {
                $table->id();
                $table->string('beneficiary_id');
                $table->string('trigger_node_id');
                $table->string('reference_node_id');
                $table->integer('position_in_cycle');
                $table->integer('tree_number');
                $table->decimal('amount', 10, 2);
                $table->timestamps();
                
                $table->index('beneficiary_id');
                $table->index('trigger_node_id');
                $table->index(['tree_number', 'position_in_cycle']);
            });
        }

        // Fast track income table
        if (!Schema::hasTable('fast_track_income')) {
            Schema::create('fast_track_income', function (Blueprint $table) {
                $table->id();
                $table->string('beneficiary_id');
                $table->integer('tree_number');
                $table->decimal('amount', 10, 2);
                $table->timestamps();
                
                $table->index('beneficiary_id');
                $table->index('tree_number');
                $table->unique(['beneficiary_id', 'tree_number']); // Prevent duplicate payments
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fast_track_income');
        Schema::dropIfExists('global_bonus_income');
        Schema::dropIfExists('team_performance_income');
        Schema::dropIfExists('re_ignite_income');
        Schema::dropIfExists('fast_track_tree');
        Schema::dropIfExists('achievement_tree');
        Schema::dropIfExists('global_tree');
        Schema::dropIfExists('team_performance_tree');
        Schema::dropIfExists('mlm_plan');
        Schema::dropIfExists('plan_activation_queue');
    }
};
