<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Co extends Model
{
    /** Misma frontera para lista, total, exportaciones, detalle y archivos. */
    public function scopeVisibleTo(Builder $query, ?User $user): Builder
    {
        if ($user?->administraSistema()) {
            return $query;
        }
        if (! $user?->cuentaActiva() || $user->tipoVigente() !== 3) {
            return $query->whereRaw('1 = 0');
        }

        // rem_id/nombres son ambiguos; los grupos esperan el snapshot de F4.
        return $query->where('tur_type', 'user')->where('tur_id', $user->getKey());
    }

    protected $table = 'cos';

    protected $fillable = [
        'legislatura',
        'legislatura_id',
        'fcap',
        'frec',
        'fofi',
        'des',
        'seguimiento',
        'rem_nombre',
        'rem_cargo',
        'rem_deporg',
        'rem_dir',
        'tur_nom',
        'tur_cargo',
        'tur_deporg',
        'ncor',
        'tcor',
        'ccor',
        'nhoj',
        'nofi',
        'estatus',
        'rem_id',
        'tur_group_id',
        'tur_type',
    ];

    protected $casts = [
        'fcap' => 'date',
        'frec' => 'date',
        'fofi' => 'date',
        'estatus' => 'boolean',
    ];

    public function legislaturaRel()
    {
        return $this->belongsTo(Legislatura::class, 'legislatura_id');
    }

    // Relación con el usuario remitente
    public function remitente()
    {
        return $this->belongsTo(User::class, 'rem_id');
    }

    // Relación con el grupo de turnado
    public function turGroup()
    {
        return $this->belongsTo(UserGroup::class, 'tur_group_id');
    }

    // Relación con archivos
    public function files()
    {
        return $this->hasMany(CosFile::class, 'cos_id');
    }

    /**
     * Obtener el nombre del turnado (usuario o grupo)
     */
    public function getTurNameAttribute()
    {
        if ($this->tur_type === 'group' && $this->turGroup) {
            return $this->turGroup->name;
        }

        return $this->tur_nom;
    }

    /**
     * Verificar si está turnado a un grupo
     */
    public function isTurnadoToGroup()
    {
        return $this->tur_type === 'group' && $this->tur_group_id;
    }

    /**
     * Verificar si está turnado a un usuario
     */
    public function isTurnadoToUser()
    {
        return $this->tur_type === 'user' || (! $this->tur_type && $this->tur_nom);
    }
}
