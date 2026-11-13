<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @return RedirectResponse
     */
    public function login(LoginRequest $request, AuthenticatedSessionController $sessions)
    {
        // Conserva el formulario propio, usando el pipeline de sesión y MFA de Fortify.
        return $sessions->store($request);
    }

    /**
     * Log the user out of the application.
     *
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
