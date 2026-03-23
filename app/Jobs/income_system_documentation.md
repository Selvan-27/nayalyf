# MLM Income Generation System Documentation

## 🎯 **Overview**
Complete income generation system implemented according to the PRD specifications, including Reignite, Team Performance, Global Bonus, and Fast Track income types.

## 📊 **Income Types Implemented**

### **1. Reignite Income (₹160)**
- **Trigger:** When rebirth ID is generated from Global Tree completion
- **Beneficiary:** Original root ID (using `original_id` field from mlm_plan)
- **Amount:** Fixed ₹160 per rebirth
- **Table:** `re_ignite_income`

### **2. Team Performance Income (₹200 - ₹16,38,400)**
- **Trigger:** Every time a new node is placed in Team Performance Tree
- **Logic:** Position-based income using breadth-first traversal
- **Income Positions:** 4th, 5th, 7th, 8th, 10th, 11th... (reference member gets paid)
- **Parent Positions:** 3rd, 6th, 9th, 12th... (parent of reference member gets paid)
- **Table:** `team_performance_income`

### **3. Global Bonus Income (₹125 - ₹2000)**
- **Trigger:** Every time a new node is placed in Global Tree
- **Logic:** Same position-based system as Team Performance
- **Table:** `global_bonus_income`

### **4. Fast Track Income (₹125/₹500)**
- **Trigger:** When member reaches 3 direct children in Fast Track tree
- **Logic:** One-time payout per tree level
- **Table:** `fast_track_income`

## 🏗 **Models Created**

```php
// Income Models
- re_ignite_income
- team_performance_income  
- global_bonus_income
- fast_track_income

// Updated Models
- mlm_plan (added original_id field)
```

## 🎮 **Controllers**

### **IncomeController**
Main controller handling all income generation:
- `generateReigniteIncome()` - ₹160 for global rebirths
- `generateTeamPerformanceIncome()` - Position-based team income
- `generateGlobalBonusIncome()` - Position-based global income  
- `generateFastTrackIncome()` - One-time fast track income

### **Updated PlanActivationController**
Integrated income generation into placement logic:
- Calls income generation after each tree placement
- Tracks original_id for rebirth members
- Generates Fast Track income when members get 3 direct children

## 💰 **Income Amounts**

### Team Performance Tree (14 trees):
```
Tree 1: ₹200        Tree 8: ₹25,600
Tree 2: ₹400        Tree 9: ₹51,200  
Tree 3: ₹800        Tree 10: ₹1,02,400
Tree 4: ₹1,600      Tree 11: ₹2,04,800
Tree 5: ₹3,200      Tree 12: ₹4,09,600
Tree 6: ₹6,400      Tree 13: ₹8,19,200
Tree 7: ₹12,800     Tree 14: ₹16,38,400
```

### Global Tree (5 trees):
```
Tree 1: ₹125        Tree 4: ₹1,000
Tree 2: ₹250        Tree 5: ₹2,000
Tree 3: ₹500
```

### Fast Track Tree (2 trees):
```
Tree 1: ₹125
Tree 2: ₹500
```

## 🔄 **Income Logic Flow**

### **Position-Based Income:**
```
When new member X is placed:

For each existing member Y in the tree:
1. Perform breadth-first traversal from Y's position
2. Find X's position in this traversal
3. If position is 4th, 5th, 7th, 8th, 10th, 11th... → Pay Y
4. If position is 3rd, 6th, 9th, 12th... → Pay Y's parent
```

### **Position Pattern:**
```
Position:  1  2  3  4  5  6  7  8  9  10 11 12 13 14 15 ...
Beneficiary:  -  -  P  R  R  P  R  R  P  R  R  P  R  R  P ...

Where: R = Reference member, P = Parent of reference member
```

## 🗄 **Database Schema**

### Income Tables:
```sql
-- All income tables have these key fields:
- id (PK)
- beneficiary_id (who receives income)
- amount (income amount)
- created_at (timestamp)

-- Position-based tables also have:
- trigger_node_id (new member that triggered income)
- reference_node_id (member from whose position calculation was done)
- position_in_cycle (3rd, 4th, 5th, etc.)
- tree_number (which tree 1-14 or 1-5)
```

## 🧪 **Testing**

### Manual Testing Routes:
```php
// Test plan activation
GET /run-plan-activation-job

// Test income generation  
GET /test-income
```

### Sample Usage:
```php
// Generate Reignite Income
$incomeController->generateReigniteIncome('rebirth123', 'original456');

// Generate Team Performance Income 
$incomeController->generateTeamPerformanceIncome('newMember789', 1);

// Generate Fast Track Income
$incomeController->generateFastTrackIncome('member456', 1);
```

## 🎯 **Key Features**

✅ **Position Counting Resets** - Each tree starts fresh with position 1, 2, 3...
✅ **Multiple Income Streams** - Every existing member can receive income from new placements
✅ **Original ID Tracking** - Proper rebirth chain tracking using original_id
✅ **Duplicate Prevention** - Fast Track income prevents duplicate payments
✅ **Comprehensive Logging** - All income generation is logged
✅ **Error Handling** - Graceful handling of edge cases

## 🚀 **Integration**

The income system is fully integrated into the plan activation flow:
1. Member gets activated → Placed in trees
2. Tree placement → Income calculated for all affected members  
3. Tree progression → Fast Track income generated when qualified
4. Rebirth generation → Reignite income for original members

All income is generated automatically as part of the normal activation and placement process! 💸
