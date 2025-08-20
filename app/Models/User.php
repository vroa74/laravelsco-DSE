<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'rfc',
        'curp',
        'direction',
        'position',
        'sex',
        'lvl',
        'tipo',
        'status',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con los registros COS donde este usuario es el remitente
     */
    public function cosRemitente()
    {
        return $this->hasMany(Cos::class, 'rem_id');
    }

    /**
     * Relación con los registros COS que este usuario creó
     */
    public function cosCreados()
    {
        return $this->hasMany(Cos::class, 'creo');
    }

    /**
     * Relación con los registros COS que este usuario modificó
     */
    public function cosModificados()
    {
        return $this->hasMany(Cos::class, 'modifico');
    }

    /**
     * Relación muchos a muchos con grupos de usuarios
     */
    public function userGroups()
    {
        return $this->belongsToMany(UserGroup::class, 'user_group_user')
                    ->withTimestamps();
    }

    /**
     * Relación con los registros CO donde este usuario es el turnado individual
     */
    public function cosTurnado()
    {
        return $this->hasMany(Co::class, 'turnado_user_id');
    }

    /**
     * Obtener el cargo del usuario (para compatibilidad)
     */
    public function getCargoAttribute()
    {
        return $this->position ?? 'N/A';
    }

    /**
     * Obtener la dependencia del usuario (para compatibilidad)
     */
    public function getDepartamentoAttribute()
    {
        return $this->direction ?? 'N/A';
    }
}
