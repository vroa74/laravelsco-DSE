<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ccor extends Model
{
    protected $fillable = [
        'tcor',
        'ccor',
        // Agrega aquí otros campos si son necesarios
    ];

    // Definir la relación si no existe ya
    public function Tcors()
    {
        return $this->belongsTo(Tcor::class, 'tcor');
    }
}
