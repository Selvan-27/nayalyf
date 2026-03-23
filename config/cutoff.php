<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cutoff Testing Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration handles both production and testing modes for
    | cutoff processing. Use environment variables to control testing
    | behavior without modifying production code.
    |
    */

    'testing_mode' => env('CUTOFF_TESTING_MODE', false),

    'bypass_time_check' => env('CUTOFF_BYPASS_TIME_CHECK', false),

    'force_date' => env('CUTOFF_FORCE_DATE', null),

    'test_time' => env('CUTOFF_TEST_TIME', '23:40:00'),

    /*
    |--------------------------------------------------------------------------
    | Production Settings
    |--------------------------------------------------------------------------
    */

    'production' => [
        'repurchase_cutoff_time' => '23:40:00',
        'awards_cutoff_time' => '23:40:00',
        'timezone' => 'Asia/Kolkata',
    ],

    /*
    |--------------------------------------------------------------------------
    | Testing Scenarios
    |--------------------------------------------------------------------------
    |
    | Predefined testing scenarios for common use cases
    |
    */

    'scenarios' => [
        'immediate' => [
            'testing_mode' => true,
            'bypass_time_check' => true,
            'description' => 'Run cutoffs immediately without time restrictions',
        ],
        
        'specific_time' => [
            'testing_mode' => true,
            'bypass_time_check' => false,
            'test_time' => '10:00:00',
            'description' => 'Run cutoffs at 10:00 AM for testing',
        ],
        
        'specific_date' => [
            'testing_mode' => true,
            'force_date' => '2025-12-01',
            'bypass_time_check' => true,
            'description' => 'Run cutoffs for specific historical date',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Safety Settings
    |--------------------------------------------------------------------------
    */

    'safety' => [
        'require_confirmation' => env('CUTOFF_REQUIRE_CONFIRMATION', true),
        'max_test_records' => env('CUTOFF_MAX_TEST_RECORDS', 100),
        'enable_rollback' => env('CUTOFF_ENABLE_ROLLBACK', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    */

    'logging' => [
        'test_log_level' => env('CUTOFF_TEST_LOG_LEVEL', 'debug'),
        'production_log_level' => env('CUTOFF_PROD_LOG_LEVEL', 'info'),
        'log_to_file' => env('CUTOFF_LOG_TO_FILE', true),
    ],
];