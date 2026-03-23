# Plan Activation Job Documentation

## Overview
The `plan_activation_job` is responsible for processing member activations in the MLM system according to the tree structure and placement rules defined in the PRD.

## Models Created

### 1. plan_activation_queue
- Stores pending activations
- Fields: `activation_id`, `activation_status`
- Status values: 'pending', 'processing', 'success', 'failed'

### 2. Tree Models
- `team_performance_tree` - 14 trees using team filling
- `global_tree` - 5 trees using global filling  
- `achievement_tree` - 1 tree using team filling
- `fast_track_tree` - 2 trees using global filling

### 3. mlm_plan
- Central member management
- Fields: `memberid`, `sponsor_id`, `placement_id`, `referral_count`, `memberid_type`, `status`

## Controllers Created

### PlanActivationController
Main controller handling activation logic:
- `processPlanActivation()` - Main activation processing
- `processTreePlacements()` - Tree placement logic
- `placeInTree()` - Places member in specific tree
- `generateGlobalRebirth()` - Creates rebirth IDs from global tree
- `generateFastTrackRebirth()` - Creates fast track rebirths

### Updated tree_traversal_controller
Enhanced with new methods:
- `findTeamPlacement()` - Team filling algorithm
- `findGlobalPlacement()` - Global filling algorithm
- `countDirectChildren()` - Count children in specific tree

## Job Logic

### Entry Rules Implementation
1. **Regular ID Entry**: Upon registration, enters Tree #1 of Team, Global, and Achievement groups
2. **Fast Track Qualification**: Enters Fast Track when member gets 3 direct referrals
3. **Rebirth Generation**: Creates rebirth IDs based on tree completion and qualifications

### Filling Algorithms
- **Global Filling**: Breadth-first search from tree root
- **Team Filling**: Starts from sponsor, searches through sponsor lineage

### Tree Progression
- Members progress to next tree after getting 3 direct children
- Rebirth generated upon completing final tree of group

## Usage

### Manual Testing
```php
// Visit route to test manually
GET /run-plan-activation-job
```

### Queue Processing
```php
// Dispatch job programmatically
dispatch(new plan_activation_job());
```

### Adding Members for Activation
```php
// Add member to activation queue
$activation = new plan_activation_queue();
$activation->activation_id = $memberId;
$activation->activation_status = 'pending';
$activation->save();
```

## Database Schema Required

```sql
-- plan_activation_queue table
CREATE TABLE plan_activation_queue (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    activation_id VARCHAR(255) NOT NULL,
    activation_status ENUM('pending', 'processing', 'success', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- mlm_plan table  
CREATE TABLE mlm_plan (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    memberid VARCHAR(255) UNIQUE NOT NULL,
    sponsor_id VARCHAR(255),
    placement_id VARCHAR(255),
    referral_count INT DEFAULT 0,
    memberid_type ENUM('regular', 'rebirth', 'fast_track_rebirth') DEFAULT 'regular',
    status TINYINT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Tree tables (similar structure for all)
CREATE TABLE team_performance_tree (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    memberid VARCHAR(255) NOT NULL,
    sponsorid VARCHAR(255),
    placement_id VARCHAR(255),
    pos VARCHAR(10),
    tree_no INT DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Repeat for: global_tree, achievement_tree, fast_track_tree
```

## Logging
The job logs all operations to Laravel logs for debugging and monitoring:
- Activation processing start/end
- Tree placements
- Rebirth generation
- Error handling

## Error Handling
- Failed activations are marked as 'failed'
- Processing records are reset to 'pending' on job failure
- Individual activation failures don't stop batch processing
- Comprehensive logging for troubleshooting
