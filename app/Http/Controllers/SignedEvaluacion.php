<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionesHechas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignedEvaluacion extends Controller
{
    function signedEvaluacion(int $id_evaluacion)
    {
        $query = EvaluacionesHechas::where('evaluacion_id', $id_evaluacion)->first();


        if (Storage::exists($query->pdf_path)) {
            $response = Storage::get($query->pdf_path);
            return response($response, 200)
                ->header('Content-Type', 'application/pdf');
        }
    }
}
