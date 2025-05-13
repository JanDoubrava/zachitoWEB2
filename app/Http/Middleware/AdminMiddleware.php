<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

// Middleware pro kontrolu oprávnění administrátora
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('AdminMiddleware: Kontrola přístupu', [
            'is_authenticated' => Auth::check(),
            'user_role' => Auth::check() ? Auth::user()->role : null,
            'path' => $request->path()
        ]);

        if (!Auth::check() || !Auth::user()->isAdmin()) {
            Log::warning('AdminMiddleware: Přístup odepřen', [
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'path' => $request->path()
            ]);

            return redirect()->route('login')
                ->with('error', 'Pro přístup do administrace musíte být přihlášeni jako administrátor.');
        }

        return $next($request);
    }
}
