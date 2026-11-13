<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $pendingChallenge = $request->routeIs('two-factor.login', 'two-factor.login.store')
            && $request->session()->has('login.id');
        if (! $user && $pendingChallenge) {
            $id = $request->session()->get('login.id');
            $user = (is_int($id) || (is_string($id) && ctype_digit($id))) ? User::find($id) : null;
        }
        if (($user && ! $user->cuentaActiva()) || ($pendingChallenge && ! $user)) {
            $currentGuard = Auth::guard();
            Auth::guard(config('fortify.guard', 'web'))->logout();
            // Sanctum puede conservar el usuario de la sesión en el guard del request.
            if (method_exists($currentGuard, 'forgetUser')) {
                $currentGuard->forgetUser();
            }
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return $request->expectsJson()
                ? response()->json(['message' => 'No se pudo autorizar el acceso.'], 403)
                : redirect()->route('login')->withErrors(['email' => 'No se pudo autorizar el acceso.']);
        }

        return $next($request);
    }
}
