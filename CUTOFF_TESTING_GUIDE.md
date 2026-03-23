# 🧪 Cutoff Testing Framework

A comprehensive testing system for MLM cutoff processing that allows flexible testing without waiting for scheduled times.

## 🚨 CRITICAL FIXES APPLIED

### Fixed Testing Issues ✅

**Problem 1: Inconsistent Testing Logic**
- ✅ **FIXED**: Both `processRepurchaseCutoff()` and `processAwardsAndRewardsCutoff()` now have identical testing environment variable support
- ✅ **FIXED**: Consistent logging and safety warnings across both methods

**Problem 2: Hard-coded Time Check**  
- ✅ **FIXED**: Replaced hard-coded `23:40:00` time check with environment-controlled testing
- ✅ **FIXED**: Both methods now respect `CUTOFF_BYPASS_TIME_CHECK` and `CUTOFF_TEST_TIME` variables

**Problem 3: Flexible Date Range Handling**
- ✅ **FIXED**: Testing mode now supports flexible date ranges - finds cutoffs that cover the forced date
- ✅ **FIXED**: Production mode maintains strict "today only" logic for safety
- ✅ **FIXED**: Proper `from_date` and `to_date` filtering throughout all processing methods

### How Date Ranges Work 📅

Both cutoff methods now properly handle date ranges from the `_cutoff_slots` tables:

```php
// Testing Mode (flexible)
->where('from_date', '<=', $currentDateTime->toDateString())
->where('to_date', '>=', $currentDateTime->toDateString())

// Production Mode (strict) 
->where('from_date', '<=', $currentDateTime->toDateString())  
->where('to_date', '=', $currentDateTime->toDateString())
```

**Real Usage of Date Ranges:**
- Repurchase counting: `->whereDate('created_at', '>=', $cutoffSlot->from_date)`
- Income calculation: `->whereDate('created_at', '<=', $cutoffSlot->to_date)`  
- Award evaluation: Uses cutoff slot date ranges for member performance assessment

## 📁 Separate Log Files

### Testing vs Production Logs ✅

**NEW**: Cutoff testing now uses separate log channels for better isolation:

- **Testing Mode**: Logs to `storage/logs/cutoff_testing.log`
- **Production Mode**: Logs to `storage/logs/cutoff_production.log`

### Log File Configuration
```bash
# Adjust log levels per environment
CUTOFF_TEST_LOG_LEVEL=debug      # Verbose testing logs
CUTOFF_PROD_LOG_LEVEL=info       # Production-appropriate logging  
CUTOFF_LOG_TO_FILE=true         # Enable file logging
```

### Monitor Logs During Testing
```bash
# Watch testing logs in real-time
tail -f storage/logs/cutoff_testing.log

# Watch production logs
tail -f storage/logs/cutoff_production.log

# Filter for specific patterns
tail -f storage/logs/cutoff_testing.log | grep -i "TESTING MODE"
tail -f storage/logs/cutoff_testing.log | grep -i "forced date"
```

### Log Indicators
Look for these key indicators in logs:

**Testing Mode Enabled:**
```
🧪 REPURCHASE TESTING MODE ENABLED - Production safety bypassed!
🧪 AWARDS TESTING MODE ENABLED - Production safety bypassed!
```

**Date Override:**
```
📅 Using forced date for repurchase testing: 2025-12-01
📅 Using forced date for awards testing: 2025-12-01
```

**Time Bypass:**
```
⚠️ Repurchase time check bypassed for testing
⚠️ Awards time check bypassed for testing
```

## 📋 Overview

The cutoff testing framework provides:

The cutoff testing framework provides:
- **Environment-based testing** with configurable parameters
- **Artisan commands** for manual cutoff execution
- **Test data generation** with realistic MLM hierarchies
- **Safety mechanisms** to prevent production issues
- **Comprehensive logging** for debugging

## 🚀 Quick Start

### 1. Setup Test Environment
```bash
# Copy environment template
cp .env.testing.example .env.testing

# Edit .env file with testing variables
CUTOFF_TESTING_MODE=true
CUTOFF_BYPASS_TIME_CHECK=true
```

### 2. Generate Test Data
```bash
# Create test members, cutoff slots, and orders
php artisan cutoff:data seed

# Check data status
php artisan cutoff:data status
```

### 3. Run Cutoff Tests
```bash
# Test repurchase cutoff (dry run)
php artisan cutoff:test repurchase --dry-run

# Run actual test
php artisan cutoff:test both --force
```

## 📚 Commands Reference

### Cutoff Testing Command
```bash
php artisan cutoff:test {type} [options]
```

**Parameters:**
- `type`: `repurchase`, `awards`, or `both`

**Options:**
- `--date=YYYY-MM-DD`: Test specific date
- `--force`: Skip confirmation
- `--dry-run`: Preview without execution
- `--verbose`: Detailed logging
- `--scenario=name`: Use predefined scenario

**Examples:**
```bash
# Test today's repurchase cutoff
php artisan cutoff:test repurchase

# Test specific date with force
php artisan cutoff:test both --date=2025-12-01 --force

# Dry run with verbose output
php artisan cutoff:test awards --dry-run --verbose

# Use immediate scenario
php artisan cutoff:test both --scenario=immediate
```

### Data Management Command
```bash
php artisan cutoff:data {action} [options]
```

**Actions:**
- `seed`: Create test data
- `clean`: Remove test data
- `reset`: Clean + seed
- `status`: Show current data

**Examples:**
```bash
# Generate test data
php artisan cutoff:data seed

# Check current status
php artisan cutoff:data status

# Clean all test data
php artisan cutoff:data clean --force

# Reset (clean + seed)
php artisan cutoff:data reset
```

## 🔧 Environment Variables

### Core Testing Variables
```bash
# Enable testing mode
CUTOFF_TESTING_MODE=true

# Bypass time restrictions
CUTOFF_BYPASS_TIME_CHECK=true

# Force specific date
CUTOFF_FORCE_DATE=2025-12-01

# Custom test time
CUTOFF_TEST_TIME=10:00:00
```

### Safety Variables
```bash
# Require confirmation for risky operations
CUTOFF_REQUIRE_CONFIRMATION=true

# Limit test records processed
CUTOFF_MAX_TEST_RECORDS=100

# Enable rollback functionality
CUTOFF_ENABLE_ROLLBACK=true
```

### Logging Variables
```bash
# Test log level (debug, info, warn, error)
CUTOFF_TEST_LOG_LEVEL=debug

# Production log level
CUTOFF_PROD_LOG_LEVEL=info

# Log to file
CUTOFF_LOG_TO_FILE=true
```

## 🎯 Testing Scenarios

### Scenario 1: Immediate Testing
Test cutoffs immediately without any time restrictions.

```bash
# Environment
CUTOFF_TESTING_MODE=true
CUTOFF_BYPASS_TIME_CHECK=true

# Command
php artisan cutoff:test both --scenario=immediate
```

### Scenario 2: Specific Time Testing
Test cutoffs at a specific time (e.g., 10:00 AM).

```bash
# Environment
CUTOFF_TESTING_MODE=true
CUTOFF_TEST_TIME=10:00:00

# Command
php artisan cutoff:test both --scenario=specific_time
```

### Scenario 3: Historical Date Testing
Test cutoffs for a specific past date.

```bash
# Environment
CUTOFF_TESTING_MODE=true
CUTOFF_FORCE_DATE=2025-12-01
CUTOFF_BYPASS_TIME_CHECK=true

# Command
php artisan cutoff:test both --scenario=specific_date
```

## 📊 Test Data Structure

### Generated Test Data
- **Root Member**: `TEST001`
- **Level 1**: `TEST101` - `TEST105` (5 members)
- **Level 2**: `TEST211` - `TEST533` (15 members)
- **Level 3**: `TEST311` - `TEST562` (30 members)

### Cutoff Slots
- Yesterday: Status `success`
- Today: Status `pending`
- Tomorrow: Status `pending`

### Ecom Orders
- 1-3 orders per member
- Random PV values (400-1600)
- Distributed across today and yesterday

### Repurchases
- 1-3 repurchases per active member
- Proper hierarchy relationships
- Random timing within test period

## 🔍 Debugging & Monitoring

### Log Monitoring
```bash
# Watch testing logs in real-time  
tail -f storage/logs/cutoff_testing.log

# Watch production logs
tail -f storage/logs/cutoff_production.log

# Filter cutoff-related logs from main log
tail -f storage/logs/laravel.log | grep -i cutoff

# Monitor specific testing patterns
tail -f storage/logs/cutoff_testing.log | grep -E "(forced date|bypassed|Testing mode)"

# Check for errors only
tail -f storage/logs/cutoff_testing.log | grep -i error
```

### Data Inspection
```bash
# Check test data status
php artisan cutoff:data status

# Verify cutoff slots
php artisan tinker
>>> App\Models\repurchase_cutoff_slots::where('status', 'pending')->get()
>>> App\Models\awards_and_rewards_cutoff_slots::where('status', 'pending')->get()
```

### Environment Check
```bash
# Verify testing mode
php artisan tinker
>>> env('CUTOFF_TESTING_MODE')
>>> env('CUTOFF_BYPASS_TIME_CHECK')
>>> env('CUTOFF_FORCE_DATE')
```

## ⚠️ Safety Guidelines

### Production Safety
1. **Never enable testing mode in production**
2. **Always use `--dry-run` first**
3. **Backup data before major tests**
4. **Monitor logs during testing**

### Testing Best Practices
1. **Use test data prefixes** (`TEST*`, `RP*`)
2. **Clean up after testing**
3. **Verify results manually**
4. **Document test scenarios**

### Rollback Procedures
```bash
# Clean test data
php artisan cutoff:data clean --force

# Reset cutoff slots to pending
php artisan tinker
>>> App\Models\repurchase_cutoff_slots::where('status', 'success')->update(['status' => 'pending'])
>>> App\Models\awards_and_rewards_cutoff_slots::where('status', 'success')->update(['status' => 'pending'])
```

## 🔬 Testing Verification

### Verify Testing Logic Works
```bash
# 1. Enable testing mode
export CUTOFF_TESTING_MODE=true
export CUTOFF_BYPASS_TIME_CHECK=true

# 2. Run dry-run to see what will be processed  
php artisan cutoff:test both --dry-run --verbose

# 3. Check logs for testing indicators
tail -f storage/logs/laravel.log | grep -E "(TESTING MODE|Testing mode|forced date)"

# 4. Verify environment detection
php artisan tinker
>>> env('CUTOFF_TESTING_MODE')      // Should return true
>>> env('CUTOFF_BYPASS_TIME_CHECK')  // Should return true
```

### Validate Date Range Processing  
```bash
# Test with specific date
export CUTOFF_FORCE_DATE=2025-12-01
php artisan cutoff:test repurchase --dry-run

# Check for "Looking for cutoff covering forced date" in logs
tail -f storage/logs/laravel.log | grep "forced date"

# Verify repurchase date filtering
php artisan tinker
>>> $slot = App\Models\repurchase_cutoff_slots::where('status', 'pending')->first()
>>> $slot->from_date  // Check start date
>>> $slot->to_date    // Check end date
```

### Test Income Calculations
```bash
# 1. Seed test data
php artisan cutoff:data seed

# 2. Run actual test  
php artisan cutoff:test both --force

# 3. Verify income records were created
php artisan tinker
>>> App\Models\repurchase_level_income::whereDate('created_at', today())->count()
>>> App\Models\achievement_level_income::whereDate('created_at', today())->count()
```

## 📈 Performance Testing

### Load Testing
```bash
# Generate large test dataset
CUTOFF_MAX_TEST_RECORDS=1000 php artisan cutoff:data seed

# Test performance
time php artisan cutoff:test both --force
```

### Memory Monitoring
```bash
# Monitor memory usage
php artisan cutoff:test both --verbose | grep -i memory
```

## 🐛 Troubleshooting

### Common Issues

**Issue: No cutoff slot found**
```bash
# Check cutoff slots
php artisan cutoff:data status

# Create test slots if missing
php artisan cutoff:data seed
```

**Issue: Time restrictions not bypassed**
```bash
# Verify environment variables
echo $CUTOFF_BYPASS_TIME_CHECK

# Set environment
export CUTOFF_BYPASS_TIME_CHECK=true
```

**Issue: No test data**
```bash
# Generate test data
php artisan cutoff:data reset --force
```

### Debug Commands
```bash
# Verbose testing
php artisan cutoff:test both --verbose --dry-run

# Check configuration
php artisan config:show cutoff

# Verify data integrity
php artisan cutoff:data status
```

## 🔮 Advanced Features

### Custom Test Scenarios
Create custom scenarios in `config/cutoff.php`:

```php
'scenarios' => [
    'my_scenario' => [
        'testing_mode' => true,
        'force_date' => '2025-11-15',
        'bypass_time_check' => true,
        'description' => 'My custom test scenario',
    ],
],
```

### Automated Testing
Set up automated daily tests:

```bash
# Add to crontab
0 9 * * * cd /path/to/project && php artisan cutoff:test both --scenario=immediate --force
```

### Integration Testing
Test with external systems:

```bash
# Test with staging database
DB_CONNECTION=staging php artisan cutoff:test repurchase --dry-run
```

## 📝 Best Practices

1. **Always start with `--dry-run`**
2. **Use descriptive test data**
3. **Monitor logs during execution**
4. **Clean up after testing**
5. **Document test results**
6. **Verify income calculations manually**
7. **Test edge cases**
8. **Use version control for test scenarios**

## 🏁 Conclusion

This testing framework provides complete control over cutoff processing, enabling thorough testing without production risks. Use it to validate income calculations, test new features, and ensure system reliability.