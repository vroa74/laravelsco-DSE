<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Relación muchos a muchos con usuarios
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group_user')
                    ->withTimestamps();
    }

    /**
     * Relación uno a muchos con registros de correspondencia
     */
    public function correspondencias()
    {
        return $this->hasMany(Co::class, 'turnado_group_id');
    }

    /**
     * Scope para grupos activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Obtener el número de usuarios en el grupo
     */
    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    /**
     * Obtener nombres de usuarios como string
     */
    public function getUsersNamesAttribute()
    {
        return $this->users()->pluck('name')->implode(', ');
    }
}
