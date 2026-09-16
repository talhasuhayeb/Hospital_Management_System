<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureResetEmailRegistered
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post') && $request->routeIs('password.email')) {
            $email = strtolower(trim((string) $request->input('email')));

            if (! User::whereRaw('LOWER(email) = ?', [$email])->exists()) {
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'No registered account was found for this email address.']);
            }
        }

        return $next($request);
    }
}
