<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'active',
        'created_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Relación con el usuario que creó el grupo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relación con los usuarios miembros del grupo
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_group_members', 'group_id', 'user_id')
                    ->withPivot('added_by')
                    ->withTimestamps();
    }

    /**
     * Relación con los reportes turnados a este grupo
     */
    public function cos(): BelongsTo
    {
        return $this->belongsTo(Co::class, 'tur_group_id');
    }

    /**
     * Obtener todos los archivos de los documentos turnados a este grupo
     */
    public function files()
    {
        return $this->hasManyThrough(
            CosFile::class,
            Co::class,
            'tur_group_id', // Foreign key en cos
            'cos_id',       // Foreign key en cos_files
            'id',           // Local key en user_groups
            'id'            // Local key en cos
        );
    }

    /**
     * Obtener documentos turnados a este grupo con sus archivos
     */
    public function documentsWithFiles()
    {
        return $this->cos()->with('files');
    }

    /**
     * Obtener solo archivos activos (menos de 10 días)
     */
    public function activeFiles()
    {
        return $this->files()->where('created_at', '>=', now()->subDays(10));
    }

    /**
     * Obtener archivos expirados (más de 10 días)
     */
    public function expiredFiles()
    {
        return $this->files()->where('created_at', '<', now()->subDays(10));
    }

    /**
     * Contar archivos activos por grupo
     */
    public function getActiveFilesCountAttribute(): int
    {
        return $this->files()->where('created_at', '>=', now()->subDays(10))->count();
    }

    /**
     * Contar archivos totales (incluyendo expirados) por grupo
     */
    public function getTotalFilesCountAttribute(): int
    {
        return $this->files()->count();
    }

    /**
     * Obtener documentos con archivos activos
     */
    public function documentsWithActiveFiles()
    {
        return $this->cos()->whereHas('files', function($query) {
            $query->where('created_at', '>=', now()->subDays(10));
        })->with(['files' => function($query) {
            $query->where('created_at', '>=', now()->subDays(10));
        }]);
    }

    /**
     * Obtener estadísticas de archivos por grupo
     */
    public function getFilesStatisticsAttribute(): array
    {
        $activeFiles = $this->files()->where('created_at', '>=', now()->subDays(10))->count();
        $totalFiles = $this->files()->count();
        $expiredFiles = $totalFiles - $activeFiles;
        
        return [
            'active' => $activeFiles,
            'expired' => $expiredFiles,
            'total' => $totalFiles,
            'expiration_date' => now()->subDays(10)->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Scope para grupos activos
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Obtener el número total de miembros
     */
    public function getMembersCountAttribute(): int
    {
        return $this->members()->count();
    }

    /**
     * Verificar si un usuario es miembro del grupo
     */
    public function hasMember(User $user): bool
    {
        return $this->members()->where('user_id', $user->id)->exists();
    }

    /**
     * Agregar un usuario al grupo
     */
    public function addMember(User $user, User $addedBy = null): void
    {
        if (!$this->hasMember($user)) {
            $this->members()->attach($user->id, [
                'added_by' => $addedBy ? $addedBy->id : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Remover un usuario del grupo
     */
    public function removeMember(User $user): void
    {
        $this->members()->detach($user->id);
    }

}