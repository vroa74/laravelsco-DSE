<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
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
     * Formato aceptado para la ruta de una foto de perfil en el disco public.
     * Debe coincidir con las reglas de validacion de la carga y con el
     * controlador que sirve la imagen.
     */
    private const PATRON_RUTA_FOTO = '/^profile-photos\/[A-Za-z0-9_-]+\.(jpg|jpeg|png|gif|webp|bmp)$/i';

    /**
     * Devuelve la ruta si es una foto de perfil servible, o null si esta vacia,
     * fuera de profile-photos, con traversal o con un formato no aceptado.
     */
    public static function rutaFotoValida(?string $ruta): ?string
    {
        return is_string($ruta) && preg_match(self::PATRON_RUTA_FOTO, $ruta) === 1 ? $ruta : null;
    }

    /**
     * URL de la fotografia de perfil realmente persistida.
     *
     * Sustituye la URL /storage/... de Jetstream, que en esta instalacion
     * apunta a public/storage (un directorio normal que no recibe las cargas
     * nuevas). La foto se sirve por la ruta autenticada usuario.foto y solo se
     * devuelve URL si la ruta es valida y el archivo existe; nunca se inventa una.
     */
    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->profile_photo_path) {
                return $this->defaultProfilePhotoUrl();
            }

            $ruta = self::rutaFotoValida($this->profile_photo_path);

            if ($ruta === null || ! Storage::disk('public')->exists($ruta)) {
                return null;
            }

            return route('usuario.foto', [
                'usuario' => $this->getKey(),
                // Version estable por archivo: cambia al sustituir la foto, no en
                // cada render y sin exponer el nombre del archivo.
                'v' => substr(hash('sha256', $ruta), 0, 12),
            ]);
        });
    }

    /**
     * Relación con los grupos de los que es miembro
     */
    public function groups()
    {
        return $this->belongsToMany(UserGroup::class, 'user_group_members', 'user_id', 'group_id')
            ->withPivot('added_by')
            ->withTimestamps();
    }

    /**
     * Relación con los grupos que ha creado
     */
    public function createdGroups()
    {
        return $this->hasMany(UserGroup::class, 'created_by');
    }

    /**
     * Relación con los reportes turnados a este usuario
     */
    public function cosTurnado()
    {
        return $this->hasMany(Co::class, 'rem_id');
    }

    /**
     * Verificar si el usuario pertenece a un grupo
     */
    public function belongsToGroup(UserGroup $group): bool
    {
        return $this->groups()->where('group_id', $group->id)->exists();
    }

    /**
     * Obtener todos los grupos activos del usuario
     */
    public function activeGroups()
    {
        return $this->groups()->where('active', true);
    }

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
}
