<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $this->persistProfile($user, $input);
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $this->persistProfile($user, $input, ['email_verified_at' => null]);

        $user->sendEmailVerificationNotification();
    }

    /** Guarda datos y referencia de foto en una sola escritura del usuario. */
    private function persistProfile(User $user, array $input, array $extra = []): void
    {
        $user->forceFill(array_merge([
            'name' => $input['name'],
            'email' => $input['email'],
        ], $extra));

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        } elseif (! $user->save()) {
            throw ValidationException::withMessages(['name' => 'No se pudo actualizar el perfil.']);
        }
    }
}
