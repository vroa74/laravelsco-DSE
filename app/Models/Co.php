<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Co extends Model
{
    protected $table = 'cos';
    
    protected $fillable = [
        'legislatura',
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
        'age_id',
        'tur_id'
    ];

    protected $casts = [
        'fcap' => 'date',
        'frec' => 'date',
        'fofi' => 'date',
        'estatus' => 'boolean',
    ];

    // Relación con la tabla ages a través de rem_id
    public function remAge()
    {
        return $this->belongsTo(Age::class, 'rem_id');
    }

    // Relación con archivos PDF
    public function files()
    {
        return $this->hasMany(CosFile::class, 'cos_id');
    }
}
