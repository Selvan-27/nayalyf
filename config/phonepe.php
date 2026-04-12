<?php
return [
    'client_id'      => env('PHONEPE_CLIENT_ID'),
    'client_secret'  => env('PHONEPE_CLIENT_SECRET'),
    'client_version' => env('PHONEPE_CLIENT_VERSION', '1'),

    // Auth token endpoint (separate from PG)
    'auth_base_url'  => env('PHONEPE_AUTH_BASE_URL', 'https://api-preprod.phonepe.com/apis/pg-sandbox'),

    // Payment API base
    'pg_base_url'    => env('PHONEPE_PG_BASE_URL', 'https://api-preprod.phonepe.com/apis/pg-sandbox'),
];