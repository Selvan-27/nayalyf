# Wallet Service Integration Documentation

## Overview
This integration connects the WalletService with the home.blade.php view through a Laravel View Composer, making wallet statistics available across all views in the application.

## Files Created/Modified

### 1. WalletComposer.php
- **Location**: `app/Http/View/Composers/WalletComposer.php`
- **Purpose**: View composer that automatically injects wallet data into views
- **Features**:
  - Fetches data from WalletService
  - Makes individual variables available
  - Provides complete data array for flexibility

### 2. AppServiceProvider.php
- **Location**: `app/Providers/AppServiceProvider.php`
- **Purpose**: Registers the WalletComposer for all views
- **Configuration**: `View::composer('*', WalletComposer::class)`

### 3. home.blade.php
- **Location**: `resources/views/home.blade.php`
- **Purpose**: Updated dashboard to display dynamic wallet statistics
- **Changes**: Replaced hardcoded values with dynamic data from WalletService

## Available Variables in Views

Thanks to the view composer, these variables are automatically available in all views:

- `$wallet_signups` - Total number of signups
- `$wallet_active_members` - Number of active members
- `$wallet_rebirths` - Number of rebirth IDs
- `$wallet_repurchases` - Number of repurchase IDs
- `$wallet_fast_track_rebirth_ids` - Number of fast track rebirth IDs
- `$wallet_data` - Complete array with all data

## Usage Examples

### In Blade Templates
```php
<!-- Display formatted numbers -->
{{ number_format($wallet_signups ?? 0) }}

<!-- Check if data exists -->
@if(isset($wallet_active_members))
    <span>Active Members: {{ $wallet_active_members }}</span>
@endif

<!-- Access complete data array -->
@foreach($wallet_data as $key => $value)
    <p>{{ ucfirst($key) }}: {{ number_format($value) }}</p>
@endforeach
```

### In Controllers (Optional)
If you need the data in a controller, you can still inject the service:
```php
public function someMethod(WalletService $walletService)
{
    $data = $walletService->get_counts_and_numbers();
    // Use the data as needed
}
```

## Benefits

1. **Global Availability**: Wallet data is available in all views without manual injection
2. **Performance**: Data is fetched once per request and shared across views
3. **Maintainability**: Centralized data fetching logic
4. **Flexibility**: Can be easily extended to include more data or applied to specific views only

## Customization

### Limit to Specific Views
To apply the composer only to specific views, modify the AppServiceProvider:
```php
View::composer(['home', 'dashboard', 'admin.*'], WalletComposer::class);
```

### Add More Data
Extend the WalletComposer to include additional data:
```php
public function compose(View $view)
{
    $walletData = $this->walletService->get_counts_and_numbers();
    $additionalData = $this->walletService->getSomeOtherData();
    
    $view->with(array_merge($walletData, $additionalData));
}
```
