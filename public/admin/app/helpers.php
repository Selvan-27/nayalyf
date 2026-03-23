<?php 

use App\Models\Option;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_option')) {
    function get_option($key, $default = null)
    {
        return Cache::remember("option_{$key}", 60, function () use ($key) {
            return optional(Option::where('key', $key)->first())->value;
        }) ?? $default;
    }
}
