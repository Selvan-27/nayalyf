<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //return $request->expectsJson() ? null : route('admin.login');

  $admin = Auth::guard('admin')->user();
    if (! $admin) {
        return redirect()->route('login');
    }

          return $next($request); 
        //  route('dashboard');
    }



// public function handle($request, Closure $next, $role = null)
// {
//     $admin = Auth::guard('admin')->user();
//     if (! $admin) {
//         return redirect()->route('admin.login');
//     }
//     if ($role && $admin->role !== $role) {
//         abort(403);
//     }
//     return $next($request);
// }


}