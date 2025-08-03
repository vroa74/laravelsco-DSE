<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cos extends Model
{
    use HasFactory;

    protected $table = 'cos';

    protected $fillable = [
        'legislatura',
        'fcap',
        'frec',
        'ncor',
        'tcor',
        'ccor',
        'fofi',
        'nofi',
        'nhoj',
        'rem_nombre',
        'rem_cargo',
        'rem_deporg',
        'rem_id',
        'rem_dir',
        'des',
        'seguimiento',
        'tur_nom',
        'tur_cargo',
        'tur_deporg',
        'creo',
        'modifico',
        'reporte',
        'estatus',
    ];

    protected $casts = [
        'fcap' => 'date',
        'frec' => 'date',
        'fofi' => 'date',
        'estatus' => 'boolean',
    ];

    /**
     * Relación con el usuario remitente
     */
    public function remitente()
    {
        return $this->belongsTo(User::class, 'rem_id');
    }

    /**
     * Relación con el usuario que creó el registro
     */
    public function creador()
    {
        return $this->belongsTo(User::class, 'creo');
    }

    /**
     * Relación con el usuario que modificó el registro
     */
    public function modificador()
    {
        return $this->belongsTo(User::class, 'modifico');
    }
}
