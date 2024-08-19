<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
    use HasFactory;

    protected $table = 'problemas';

    protected $fillable =
    [
        'evaluacion_id',
        'inciso',
        'operando_uno',
        'operando_dos',
        'respuesta_correcta',
    ];
}
