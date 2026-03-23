# Repurchase ID Generation System - PRD

## Overview
The Repurchase ID Generation System automatically creates additional member IDs based on accumulated Purchase Value (PV) from e-commerce orders. This system incentivizes continuous purchasing by converting PV into new earning opportunities within the MLM structure.

## Core Logic

### Trigger Conditions
1. **Primary Trigger:** No pending activations in `plan_activation_queue`
2. **PV Threshold:** User has accumulated PV >= 1600 in `ecom_orders` table
3. **Automatic Execution:** Runs during regular plan activation job cycles

### PV Calculation Formula
```
Available PV = SUM(PV from ecom_orders by user_id) - (Existing Repurchase Count × 1600)
New Repurchase IDs = FLOOR(Available PV / 1600)
```

### Generation Examples
- **User PV: 1600** → Generate 1 repurchase ID
- **User PV: 3300** → Generate 2 repurchase IDs  
- **User PV: 4950** → Generate 3 repurchase IDs
- **User PV: 5000** → Generate 3 repurchase IDs (500 PV remains for future)

## Database Structure

### MLM Plan Entry for Repurchase IDs
```php
mlm_plan {
    memberid: "RP123456"           // Prefix "RP" + unique 6-digit number
    sponsor_id: user_id            // Original user who accumulated PV
    placement_id: user_id          // Same as sponsor_id
    original_id: user_id           // Same as sponsor_id
    all_father_id: user_id         // Same as sponsor_id (for Fast Track inheritance)
    memberid_type: "repurchase"    // Identifier for repurchase IDs
    referral_count: 0              // Starts at zero
    status: 0                      // Pending activation
}
```

### Activation Queue Entry
```php
plan_activation_queue {
    login_id: user_id              // Original user
    activation_id: "RP123456"      // The repurchase ID
    activation_status: "pending"   // Standard activation flow
    status: "success"              // Queue entry status
}
```

## Tree Placement Rules

### Standard Trees (Always Enter)
1. **Team Performance Tree #1**
   - **Filling Method:** Team filling
   - **Start Point:** `original_id` (not sponsor_id)
   - **Logic:** Search hierarchy starting from original user
   
2. **Global Tree #1**
   - **Filling Method:** Global filling (breadth-first)
   - **Start Point:** Tree root
   - **Logic:** Standard global placement algorithm

### Excluded Trees
1. **Achievement Tree**
   - **Status:** Repurchase IDs do NOT enter Achievement Tree
   - **Reason:** Achievement trees are reserved for regular/rebirth member progression

### Conditional Trees
1. **Fast Track Tree #1**
   - **Condition:** `all_father_id` must be qualified for Fast Track
   - **Qualification Check:** Same logic as rebirth Fast Track inheritance
   - **Filling Method:** Global filling if qualified

## Fast Track Inheritance Logic

### Qualification Check for all_father_id
```php
isOriginalIdQualifiedForFastTrack(all_father_id) {
    // Method 1: Direct Fast Track presence
    if (fast_track_tree.memberid == all_father_id) return true;
    
    // Method 2: Rebirth Fast Track presence
    if (any rebirth of all_father_id in fast_track_tree) return true;
    
    // Method 3: 3+ active referrals count
    if (active_referrals_count >= 3) return true;
    
    return false;
}
```

### Automatic Placement Logic
- **If Qualified:** Repurchase ID automatically enters Fast Track Tree #1
- **If Not Qualified:** Repurchase ID skips Fast Track (enters only Team + Global)
- **Inheritance Chain:** All repurchase IDs from same user follow same qualification

## Income Generation

### Applicable Income Types
1. **Team Performance Income** ✅
   - Triggered when repurchase ID placed in team tree
   - Same cascade logic as regular members
   - Uses count-based system with ignored status
   
2. **Global Bonus Income** ✅
   - Triggered when repurchase ID placed in global tree
   - Same cascade logic as regular members
   - Uses count-based system with ignored status

3. **Fast Track Income** ✅
   - Only if repurchase ID enters Fast Track
   - Same logic as other Fast Track members

### Excluded Income Types
1. **Referral Income** ❌ (Repurchase IDs don't have direct referrals)
2. **Achievement Income** ❌ (Not in Achievement Tree)

## System Flow

### Step-by-Step Process
1. **Trigger Check**
   ```
   IF (pending_activations.count == 0) {
       checkAndGenerateRepurchaseIds()
   }
   ```

2. **PV Analysis**
   ```sql
   SELECT user_id, SUM(PV) as total_pv 
   FROM ecom_orders 
   GROUP BY user_id 
   HAVING total_pv >= 1600
   ```

3. **Count Existing Repurchases**
   ```sql
   SELECT COUNT(*) FROM mlm_plan 
   WHERE all_father_id = user_id 
   AND memberid_type = 'repurchase'
   ```

4. **Calculate New Repurchases**
   ```
   available_pv = total_pv - (existing_count × 1600)
   new_count = FLOOR(available_pv / 1600)
   ```

5. **Generate Repurchase IDs**
   - Create MLM plan entries
   - Add to activation queue
   - Process through standard activation flow

6. **Tree Placement**
   - Team Tree (from original_id)
   - Global Tree (standard)
   - Fast Track (if qualified)
   - Skip Achievement

7. **Income Generation**
   - Team Performance cascade
   - Global Bonus cascade
   - Fast Track cascade (if applicable)

## Logging and Monitoring

### Key Log Messages
```
🛒 Checking for repurchase ID generation opportunities...
🎯 User 123456: Total PV: 5000, Used PV: 3300, Available PV: 1700
🆕 Generating 1 new repurchase IDs for user 123456
🛒 Generating repurchase ID: RP789123 for user: 123456
🛒 Processing repurchase ID tree placements for: RP789123
🛒 Checking Fast Track qualification for repurchase RP789123 with all_father_id: 123456
🎯 All Father ID 123456 is qualified for Fast Track - placing repurchase RP789123 in Fast Track Tree #1
✅ Successfully placed repurchase RP789123 in Fast Track Tree #1
```

### Performance Monitoring
- Track PV accumulation rates
- Monitor repurchase generation frequency
- Measure activation success rates
- Analyze income generation patterns

## Business Benefits

### For Users
1. **PV Utilization:** Convert accumulated PV into earning opportunities
2. **Passive Income:** Repurchase IDs generate income without additional referrals
3. **Fast Track Access:** Inherit Fast Track benefits from original qualification

### for System
1. **Purchase Incentive:** Encourages continued e-commerce engagement
2. **Income Distribution:** Creates additional income flow opportunities
3. **Retention:** Provides long-term value for active purchasers

## Technical Considerations

### Database Performance
- Index on `ecom_orders.user_id` for PV aggregation
- Index on `mlm_plan.all_father_id` for repurchase counting
- Batch processing to avoid timeout issues

### Queue Management
- Repurchase generation only when queue is empty
- Standard activation flow prevents conflicts
- Failed activation handling same as regular IDs

### Scalability
- PV thresholds can be adjusted (currently 1600)
- Generation limits can be implemented if needed
- Monitoring for system load management

## Future Enhancements

### Potential Features
1. **Dynamic PV Thresholds:** Adjust based on user activity levels
2. **Repurchase Limits:** Maximum repurchases per user per period
3. **Special Repurchase Trees:** Dedicated trees for repurchase members
4. **Enhanced Income Multipliers:** Bonus rates for repurchase-generated income

### Configuration Options
1. **PV_THRESHOLD:** Currently 1600, make configurable
2. **GENERATION_LIMIT:** Maximum repurchases per batch
3. **FAST_TRACK_INHERITANCE:** Enable/disable Fast Track auto-entry

This PRD establishes the foundation for converting e-commerce engagement into MLM earning opportunities while maintaining system integrity and performance.
