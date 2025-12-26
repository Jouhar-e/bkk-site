<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForceChangePassword
{
    public function handle(Request $request, Closure $next)
    {
        $student = Auth::guard('student')->user();

        if ($student && $student->must_change_password) {
            if (! $request->routeIs([
                'filament.student.auth.login',
                'filament.student.auth.logout',
                'filament.student.pages.change-password',
            ])) {
                return redirect()->route('filament.student.pages.change-password');
            }
        }

        return $next($request);
    }
}
