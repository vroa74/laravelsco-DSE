<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    protected $fillable = [
        'titulo',
        'nombre',
        'apaterno',
        'amaterno',
        'cargo',
        'deporg',
        'telefono',
        'email',
        'dir',
        'modifico',
    ];
}
