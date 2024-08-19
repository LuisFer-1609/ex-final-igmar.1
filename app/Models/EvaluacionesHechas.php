<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionesHechas extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones_hechas';

    protected $fillable =
    [
        'user_id',
        'evaluacion_id',
        'pdf_path',
        'signed_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'evaluacion_id', 'id');
    }
}
