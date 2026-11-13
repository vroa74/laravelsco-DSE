<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Timebox;

class AuthenticateUser
{
    /** Misma comprobación para el login propio y el pipeline efectivo de Fortify. */
    public function __invoke(Request $request): ?User
    {
        return (new Timebox)->call(function () use ($request) {
            $email = $request->input('email');
            $rfc = $request->input('rfc');
            $password = $request->input('password');
            if (! is_string($email) || ! is_string($rfc) || ! is_string($password)) {
                return null;
            }
            $user = User::where('email', $email)->where('rfc', $rfc)->first();
            if (! $user || ! $user->cuentaActiva() || ! Hash::check($password, $user->password)) {
                return null;
            }

            return $user;
        }, 200000);
    }
}
