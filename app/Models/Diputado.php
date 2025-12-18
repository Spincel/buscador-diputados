<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diputado extends Model
{
    protected $fillable = [
        'distrito',
        'nombre',
        'enlace',
        'imagen',
        'secciones',
        'municipios',
        'type',
        'partido',
        'partido_color',
        'partido_logo',
    ];
}
