# Team Performance Income - Enhanced Cascade Recording System PRD

## Overview
This document describes the enhanced team performance income generation system with comprehensive cascade recording. The system ensures every income transaction in the cascade is recorded, maintaining accurate income counts and providing complete audit trails.

## Core Logic

### Trigger Event
When a new member is placed under parent P in the team performance tree:
1. Parent P's income count is incremented by 1
2. The cascade evaluation begins from parent P

### Count-Based Cascade Logic

#### Income Count Evaluation
```
current_count = existing_income_records_count + 1

if (current_count % 3 !== 0):
    // Member keeps the income
    CREATE income_record(member_id, ignored=0 or 1 based on rules)
else:
    // Member passes income up
    CREATE income_record(member_id, ignored=1) // Passer record
    if (parent exists):
        parent_count = parent_existing_records + 1
        // Continue cascade with parent
    else:
        // Root node special case
        CREATE income_record(member_id, ignored=1) // Root pass-up record
```

## Enhanced Recording System

### Complete Income Tracking
Every step in the cascade creates income records for:

#### 1. Passer Records (Always Ignored)
- **When:** Member's count is divisible by 3
- **Action:** Create income record with `ignored = 1`
- **Purpose:** Track income flow and maintain count accuracy
- **Log:** "Member X passes up payout - recorded as IGNORED"

#### 2. Keeper Records (Conditional Ignored)
- **When:** Member's count is NOT divisible by 3 OR root receives pass-up
- **Action:** Create income record with `ignored = 0/1` based on rules
- **Purpose:** Track final beneficiary

### Ignored Income Rules

#### Rule 1: First Two Incomes
```
if (income_count <= 2):
    ignored = 1
    reason = "First 2 incomes for any member"
```

#### Rule 2: Passer Income
```
if (member_is_passing_income_up):
    ignored = 1
    reason = "Member is passing income up"
```

#### Rule 3: Root Pass-up Income
```
if (income_passed_to_root_with_no_parent):
    ignored = 1
    reason = "Income passed to root"
```

#### Rule 4: Regular Keeper Income
```
if (member_keeps_income && income_count > 2 && !root_passup):
    ignored = 0
    reason = "Regular income kept by member"
```

## Cascade Examples

### Example 1: Standard Flow
**Scenario:** New member added under Member A (count=1)

```
Step 1: Member A (count: 1→2)
- Action: Keep income (2 % 3 ≠ 0)
- Record: ignored=1 (first 2 incomes rule)
- Result: A keeps income but it's ignored

Flow: A keeps → END
Records: 1 record (A: ignored=1)
```

### Example 2: Single Pass-up
**Scenario:** New member added under Member A (count=2)

```
Step 1: Member A (count: 2→3)
- Action: Pass up (3 % 3 = 0)
- Record: ignored=1 (passer rule)

Step 2: Parent B (count: 1→2) 
- Action: Keep income (2 % 3 ≠ 0)
- Record: ignored=1 (first 2 incomes rule)
- Result: B keeps income but it's ignored

Flow: A passes → B keeps → END
Records: 2 records (A: ignored=1, B: ignored=1)
```

### Example 3: Multiple Pass-ups
**Scenario:** New member added under Member A (count=5)

```
Step 1: Member A (count: 5→6)
- Action: Pass up (6 % 3 = 0)
- Record: ignored=1 (passer rule)

Step 2: Parent B (count: 2→3)
- Action: Pass up (3 % 3 = 0)  
- Record: ignored=1 (passer rule)

Step 3: Grandparent C (count: 3→4)
- Action: Keep income (4 % 3 ≠ 0)
- Record: ignored=0 (regular income > 2 counts)
- Result: C gets paid real income

Flow: A passes → B passes → C keeps → END
Records: 3 records (A: ignored=1, B: ignored=1, C: ignored=0)
```

### Example 4: Root Node Case
**Scenario:** New member added under Root (count=2)

```
Step 1: Root (count: 2→3)
- Action: Pass up (3 % 3 = 0) but no parent exists
- Record 1: ignored=1 (passer rule)
- Record 2: ignored=1 (root pass-up rule)
- Result: Root gets both records but both ignored

Flow: Root passes (nowhere) → Root keeps → END
Records: 2 records (Root: ignored=1, Root: ignored=1)
```

## Database Schema

### team_performance_income Table
```sql
- memberid: INT (beneficiary)
- fromId: INT (trigger member who caused the placement)
- tree_number: INT (tree level 1-14)
- payout: DECIMAL (amount based on tree level)
- netpay: DECIMAL (same as payout)
- ignored: TINYINT (0=real income, 1=ignored income)
- created_at: TIMESTAMP
```

### Income Amounts by Tree Level
```php
protected $teamPerformanceAmounts = [
    1 => 200, 2 => 400, 3 => 800, 4 => 1600, 
    5 => 3200, 6 => 6400, 7 => 12800, 8 => 25600,
    9 => 51200, 10 => 102400, 11 => 204800, 12 => 409600,
    13 => 819200, 14 => 1638400
];
```

## Benefits of Enhanced System

### 1. Accurate Income Counting
- Every transaction increments member's count
- Prevents count stagnation after 2 incomes
- Maintains proper cascade flow

### 2. Complete Audit Trail
- Track every income movement
- Identify pass-up chains
- Debug income flow issues

### 3. Flexible Reporting
- Calculate real payouts: `WHERE ignored = 0`
- Show all transactions: `WHERE ignored IN (0,1)`
- Track pass-up frequency: `WHERE ignored = 1`

### 4. Data Integrity
- No lost income events
- Consistent count tracking
- Clear income classification

## Implementation Notes

### Performance Considerations
- Multiple database inserts per placement
- Index on (memberid, tree_number) for count queries
- Consider batch processing for high volume

### Logging Strategy
- Detailed logs for each cascade step
- Clear action indicators (keep/pass/root)
- Income amount and count tracking

### Error Handling
- Graceful handling of database failures
- Rollback on partial cascade completion
- Comprehensive error logging

## Global Bonus Income

The same enhanced cascade recording system applies to Global Bonus Income with identical logic but different amounts:

```php
protected $globalBonusAmounts = [
    1 => 125, 2 => 250, 3 => 500, 4 => 1000, 5 => 2000
];
```

All rules, examples, and benefits apply equally to both income types.
