<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $roles = is_array($roles) ? $roles : [$roles];

        if (!empty($roles)) {
            /** @var User $user */
            $user = Auth::guard()->user();

            if (!in_array($user->role, $roles)) {
                return $user->isAdmin() ?
                    redirect()->route('admin.dashboard') : redirect()->route('dashboard.index');
            }
        }

        return $next($request);
    }
}
