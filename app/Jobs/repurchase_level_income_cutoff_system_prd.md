# Repurchase Level Income Cutoff System - PRD

## Overview
The Repurchase Level Income Cutoff System calculates and distributes income to regular members based on repurchase activities within their 14-level downline hierarchy during specific cutoff periods.

## Core Concept

### Hierarchy-Based Income Distribution
- **Source:** Regular members (memberid_type = 'regular')
- **Target:** 14-level downline hierarchy using sponsor_id relationships
- **Trigger:** Repurchase IDs generated during cutoff periods
- **Distribution:** Income flows to the hierarchy top (regular member)

## System Components

### 1. Database Tables

#### repurchase_cutoff_slots
```sql
CREATE TABLE repurchase_cutoff_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    from_date DATE NOT NULL,
    to_date DATE NOT NULL,
    status ENUM('pending', 'success') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### repurchase_level_income (existing)
```sql
repurchase_level_income {
    id,
    memberid,       -- Regular member receiving income
    fromId,         -- Repurchase ID that generated income
    level,          -- Hierarchy level (1-14)
    payout,         -- Income amount
    netpay,         -- Same as payout
    cutoff_slot_id, -- Reference to cutoff period
    created_at,
    updated_at
}
```

### 2. Income Rate Structure (Per Level)
```php
Level-based income rates (per repurchase ID):
Level 1:  ₹85    Level 8:  ₹38
Level 2:  ₹72    Level 9:  ₹34
Level 3:  ₹64    Level 10: ₹31
Level 4:  ₹58    Level 11: ₹28
Level 5:  ₹53    Level 12: ₹25
Level 6:  ₹47    Level 13: ₹22
Level 7:  ₹42    Level 14: ₹19
```

## System Flow

### 1. Cutoff Period Activation
```php
// Admin creates cutoff slot
INSERT INTO repurchase_cutoff_slots 
(name, from_date, to_date, status) 
VALUES ('Q1 2025 Cutoff', '2025-01-01', '2025-03-31', 'pending');
```

### 2. Automatic Processing Trigger
- **When:** No pending activations in queue
- **Check:** Current date falls within active cutoff period
- **Status:** Only processes 'pending' cutoff slots

### 3. Member Processing Loop
```php
For each Regular Member in mlm_plan:
    1. Build 14-level hierarchy using sponsor_id
    2. For each level (1-14):
        - Find all regular members at that level
        - Count their repurchase IDs created during cutoff period
        - Calculate income: count × level_rate
        - Create income records
    3. Sum total income across all levels
```

### 4. Hierarchy Building Algorithm
```php
function get14LevelHierarchy(startMemberId) {
    hierarchy = []
    currentLevel = [startMemberId]
    
    for level = 1 to 14:
        nextLevel = members where sponsor_id IN currentLevel 
                   AND memberid_type = 'regular'
        
        if nextLevel is not empty:
            hierarchy[level] = nextLevel
            currentLevel = nextLevel
        else:
            break
    
    return hierarchy
}
```

## Calculation Examples

### Example 1: Simple Hierarchy
```
Regular Member A (ID: 123456)
├── Level 1: Member B, Member C
├── Level 2: Member D (sponsored by B)
└── Level 3: Member E (sponsored by D)

Cutoff Period: Jan 1-31, 2025
Repurchases during period:
- Member B: 2 repurchase IDs
- Member C: 1 repurchase ID  
- Member D: 3 repurchase IDs
- Member E: 1 repurchase ID

Income Calculation for Member A:
- Level 1: (2 + 1) × ₹85 = ₹255
- Level 2: 3 × ₹72 = ₹216
- Level 3: 1 × ₹64 = ₹64
Total: ₹535
```

### Example 2: Income Records Created
```php
// For Member A from above example:
repurchase_level_income records:
1. memberid=123456, fromId=RP789001, level=1, payout=85
2. memberid=123456, fromId=RP789002, level=1, payout=85  
3. memberid=123456, fromId=RP789003, level=1, payout=85
4. memberid=123456, fromId=RP789004, level=2, payout=72
5. memberid=123456, fromId=RP789005, level=2, payout=72
6. memberid=123456, fromId=RP789006, level=2, payout=72
7. memberid=123456, fromId=RP789007, level=3, payout=64
```

## Key Features

### 1. **Period-Based Processing**
- Only processes repurchase IDs created during cutoff period
- One-time calculation per cutoff slot
- Prevents duplicate income generation

### 2. **Hierarchy Depth Control**
- Fixed 14-level hierarchy depth
- Only includes regular members in hierarchy
- Stops when no more sponsored members found

### 3. **Individual Income Tracking**
- Separate record for each repurchase ID
- Tracks exact source (fromId) and level
- Links to specific cutoff period

### 4. **Automatic Status Management**
- Cutoff slots marked as 'success' after completion
- Prevents reprocessing of completed periods
- Clear audit trail

## Integration Points

### 1. **Plan Activation Job Integration**
```php
// In handle() method after repurchase generation:
if (no pending activations) {
    checkAndGenerateRepurchaseIds();
    processRepurchaseCutoff();  // New addition
}
```

### 2. **Logging and Monitoring**
```
💰 Checking for repurchase level income cutoff processing...
💰 Processing cutoff slot: Q1 2025 (2025-01-01 to 2025-03-31)
🔍 Calculating repurchase level income for regular member: 123456
💰 Level 1: Member 789012 contributed 2 repurchases = ₹170
💰 Member 123456 earned ₹535 from 7 repurchases across 14 levels
✅ Completed cutoff slot: Q1 2025
```

## Administrative Operations

### 1. **Create Cutoff Periods**
```sql
-- Monthly cutoff
INSERT INTO repurchase_cutoff_slots 
(name, from_date, to_date, status) 
VALUES ('March 2025', '2025-03-01', '2025-03-31', 'pending');

-- Quarterly cutoff  
INSERT INTO repurchase_cutoff_slots 
(name, from_date, to_date, status) 
VALUES ('Q2 2025', '2025-04-01', '2025-06-30', 'pending');
```

### 2. **Monitor Processing Status**
```sql
-- Check cutoff slot status
SELECT * FROM repurchase_cutoff_slots 
WHERE status = 'pending' 
ORDER BY from_date;

-- View income distribution
SELECT memberid, SUM(payout) as total_income, COUNT(*) as total_repurchases
FROM repurchase_level_income 
WHERE cutoff_slot_id = 1
GROUP BY memberid
ORDER BY total_income DESC;
```

### 3. **Income Reports**
```sql
-- Level-wise income distribution
SELECT level, SUM(payout) as level_income, COUNT(*) as repurchase_count
FROM repurchase_level_income 
WHERE cutoff_slot_id = 1
GROUP BY level
ORDER BY level;

-- Top earners in cutoff period
SELECT memberid, SUM(payout) as total_income
FROM repurchase_level_income 
WHERE cutoff_slot_id = 1
GROUP BY memberid
ORDER BY total_income DESC
LIMIT 10;
```

## Performance Considerations

### 1. **Processing Efficiency**
- Processes only during idle periods (no pending activations)
- One-time calculation per cutoff slot
- Hierarchical processing to minimize database queries

### 2. **Database Optimization**
- Index on `repurchase_cutoff_slots(from_date, to_date, status)`
- Index on `mlm_plan(sponsor_id, memberid_type)`
- Index on `mlm_plan(all_father_id, memberid_type, created_at)`

### 3. **Memory Management**
- Processes one regular member at a time
- Hierarchy built incrementally
- Batch processing of income records

## Business Impact

### 1. **Income Distribution**
- Rewards regular members for building active downlines
- Encourages repurchase activity throughout the organization
- Creates passive income opportunities

### 2. **System Scalability**
- Handles large hierarchies efficiently
- Configurable income rates per level
- Flexible cutoff period management

This system provides a comprehensive framework for distributing repurchase-based income across member hierarchies while maintaining accurate tracking and preventing duplicate processing.
