# Fast Track Rebirth Auto-Placement Test Cases

## Test Case 1: Original ID with 3+ Referrals
**Scenario:** Original member 123456 has 3 active referrals and generates a global rebirth

### Expected Flow:
1. Member 123456 completes Global Tree #5 and gets 3 direct children
2. System generates rebirth ID: RB789123  
3. `isOriginalIdQualifiedForFastTrack(123456)` returns `true` (has 3+ referrals)
4. During activation of RB789123:
   - Places in team_performance_tree #1
   - Places in global_tree #1  
   - Places in achievement_tree #1
   - **Automatically places in fast_track_tree #1** ✅

### Log Expected:
```
🔍 Checking Fast Track qualification for rebirth RB789123 with root original_id: 123456
Original ID 123456 has 3 referrals (>=3) - QUALIFIED for Fast Track
🎉 Root original ID 123456 is qualified for Fast Track!
📋 Rebirth RB789123 will be automatically placed in Fast Track during activation process
🎯 Original ID 123456 is qualified for Fast Track - placing rebirth RB789123 in Fast Track Tree #1
✅ Successfully placed rebirth RB789123 in Fast Track Tree #1
```

## Test Case 2: Original ID Already in Fast Track
**Scenario:** Original member 456789 is already in Fast Track and generates a rebirth

### Expected Flow:
1. Member 456789 (already in fast_track_tree) generates rebirth RB321456
2. `isOriginalIdQualifiedForFastTrack(456789)` returns `true` (found in fast_track_tree)
3. Rebirth automatically enters Fast Track ✅

### Log Expected:
```
Original ID 456789 found in Fast Track tree - QUALIFIED
🎉 Root original ID 456789 is qualified for Fast Track!
✅ Successfully placed rebirth RB321456 in Fast Track Tree #1
```

## Test Case 3: Chain of Rebirths
**Scenario:** Original member 111222 → Rebirth RB333444 → New Rebirth RB555666

### Expected Flow:
1. Member 111222 (in Fast Track) generates RB333444
2. RB333444 automatically enters Fast Track
3. Later, RB333444 generates another rebirth RB555666
4. `isOriginalIdQualifiedForFastTrack(111222)` returns `true` (original root)
5. RB555666 automatically enters Fast Track ✅

## Test Case 4: Not Qualified
**Scenario:** Original member 777888 has only 2 referrals and generates a rebirth

### Expected Flow:
1. Member 777888 generates rebirth RB999000
2. `isOriginalIdQualifiedForFastTrack(777888)` returns `false` (only 2 referrals)
3. Rebirth enters only standard trees (Team, Global, Achievement)
4. **Does NOT enter Fast Track** ✅

### Log Expected:
```
Original ID 777888 has only 2 referrals (<3) - NOT QUALIFIED
⏳ Root original ID 777888 is not yet qualified for Fast Track
📋 Rebirth RB999000 will only enter standard trees (Team, Global, Achievement)
```

## Key Implementation Points

### 1. Qualification Check Methods
- **Method 1:** Check if original_id is in fast_track_tree
- **Method 2:** Check if any rebirth of original_id is in fast_track_tree  
- **Method 3:** Check if original_id has 3+ active referrals

### 2. Automatic Placement Logic
- Qualification check happens during rebirth generation
- Actual placement happens during activation in `processTreePlacements()`
- Works for any depth of rebirth chain (all track back to root original_id)

### 3. Database Structure
```sql
mlm_plan:
- memberid (RB789123)
- memberid_type ('rebirth')
- original_id (123456) -- Tracks root original ID

fast_track_tree:
- memberid (RB789123) -- Rebirth automatically placed
- tree_no (1)
- placement_id, etc.
```

This implementation ensures that once an original member qualifies for Fast Track (by having 3 referrals or being placed there), ALL future rebirths from that lineage automatically inherit Fast Track access, maintaining the MLM system's progression logic.
