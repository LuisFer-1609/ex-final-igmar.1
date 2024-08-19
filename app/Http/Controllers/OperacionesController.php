<?php

namespace App\Http\Controllers;

use App\Mail\Prueba;
use App\Mail\ResultadoEvaluacion;
use App\Models\Evaluacion;
use App\Models\EvaluacionesHechas;
use App\Models\Problema;
use App\Models\Respuesta;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class OperacionesController extends Controller
{
    function evaluacion()
    {

        if (Auth::user()->rol === 1) {
            return view(
                'admin',
                [
                    'evaluaciones_hechas' => EvaluacionesHechas::with('user')->with('evaluacion')->get()
                ]
            );
        }

        $evaluacion = Evaluacion::create(['nombre' => 'Evaluacion de prueba']);

        $lastId = $evaluacion->id;

        $operaciones = [];
        $respuestas = [];

        $sumas = [];
        $restas = [];
        $multiplicaciones = [];
        $divisiones = [];

        for ($i = 0; $i < 5; $i++) {
            $operando_uno = rand(1, 10);
            $operando_dos = rand(1, 10);
            array_push(
                $sumas,
                [
                    'evaluacion_id' => $lastId,
                    'inciso' => $i + 1,
                    'descripcion' => 'La suma estos dos numeros es: ',
                    'operando_uno' => decbin($operando_uno),
                    'operando_dos' => decbin($operando_dos),
                    'respuesta_correcta' => decbin($operando_uno + $operando_dos),
                    'tipo' => 'suma',
                ]
            );
        }

        for ($i = 0; $i < 5; $i++) {
            $operando_uno = rand(1, 10);
            $operando_dos = rand(1, 10);
            $mayor = ($operando_uno > $operando_dos) ? $operando_uno : $operando_dos;
            $menor = ($operando_uno < $operando_dos) ? $operando_dos : $operando_uno;
            array_push(
                $restas,
                [
                    'evaluacion_id' => $lastId,
                    'inciso' => $i + 1,
                    'descripcion' => 'La resta estos dos numeros es: ',
                    'operando_uno' => decbin($mayor),
                    'operando_dos' => decbin($menor),
                    'respuesta_correcta' => decbin($mayor - $menor),
                    'tipo' => 'resta',
                ]
            );
        }

        for ($i = 0; $i < 5; $i++) {
            $operando_uno = rand(1, 10);
            $operando_dos = rand(1, 10);
            $mayor = ($operando_uno > $operando_dos) ? $operando_uno : $operando_dos;
            $menor = ($operando_uno < $operando_dos) ? $operando_dos : $operando_uno;
            array_push(
                $multiplicaciones,
                [
                    'evaluacion_id' => $lastId,
                    'inciso' => $i + 1,
                    'descripcion' => 'La multiplicacion estos dos numeros es: ',
                    'operando_uno' => decbin($mayor),
                    'operando_dos' => decbin($menor),
                    'respuesta_correcta' => decbin($mayor * $menor),
                    'tipo' => 'multiplicacion',
                ]
            );
        }

        for ($i = 0; $i < 5; $i++) {
            $operando_uno = rand(1, 10);
            $operando_dos = rand(1, 10);
            $mayor = ($operando_uno > $operando_dos) ? $operando_uno : $operando_dos;
            $menor = ($operando_uno < $operando_dos) ? $operando_dos : $operando_uno;
            array_push(
                $divisiones,
                [
                    'evaluacion_id' => $lastId,
                    'inciso' => $i + 1,
                    'descripcion' => 'La division estos dos numeros es: ',
                    'operando_uno' => decbin($mayor),
                    'operando_dos' => decbin($menor),
                    'respuesta_correcta' => decbin($mayor / $menor),
                    'tipo' => 'division',
                ]
            );
        }

        $problemas =
            [
                $sumas,
                $restas,
                $multiplicaciones,
                $divisiones,
            ];

        foreach ($problemas as $problema) {
            Problema::insert($problema);
        }

        // return $problemas;

        return view(
            'dashboard',
            [
                'evaluacion' => $lastId,
                'problema' => $i + 1,
                'usuarios' => User::all(),
                'sumas' => $sumas,
                'restas' => $restas,
                'multiplicaciones' => $multiplicaciones,
                'divisiones' => $divisiones,
                'respuestas' => $respuestas,
                'lastId' => $lastId
            ]
        );
    }

    function postEvaluacion(Request $request)
    {
        $sumas = Problema::select('id', 'respuesta_correcta')->where('evaluacion_id', $request->lastId)->where('tipo', 'suma')->get();
        $restas = Problema::select('id', 'respuesta_correcta')->where('evaluacion_id', $request->lastId)->where('tipo', 'resta')->get();
        $multiplicaciones = Problema::select('id', 'respuesta_correcta')->where('evaluacion_id', $request->lastId)->where('tipo', 'multiplicacion')->get();
        $divisiones = Problema::select('id', 'respuesta_correcta')->where('evaluacion_id', $request->lastId)->where('tipo', 'division')->get();

        // return $sumas;

        $es_correcto = false;

        //Comparar sumas
        foreach ($sumas as $index => $suma) {
            ($request['respuestas']['suma'][$index] === $suma->respuesta_correcta) ? $es_correcto = true : $es_correcto = false;

            Respuesta::create(
                [
                    'problema_id' => $suma->id,
                    'respuesta' => $request['respuestas']['suma'][$index],
                    'es_correcta' => $es_correcto
                ]
            );
        }

        foreach ($restas as $index => $resta) {
            ($request['respuestas']['resta'][$index] === $resta->respuesta_correcta) ? $es_correcto = true : $es_correcto = false;

            Respuesta::create(
                [
                    'problema_id' => $resta->id,
                    'respuesta' => $request['respuestas']['resta'][$index],
                    'es_correcta' => $es_correcto
                ]
            );
        }

        foreach ($multiplicaciones as $index => $multiplicacion) {
            ($request['respuestas']['multiplicacion'][$index] === $multiplicacion->respuesta_correcta) ? $es_correcto = true : $es_correcto = false;

            Respuesta::create(
                [
                    'problema_id' => $multiplicacion->id,
                    'respuesta' => $request['respuestas']['multiplicacion'][$index],
                    'es_correcta' => $es_correcto
                ]
            );
        }

        foreach ($divisiones as $index => $division) {
            ($request['respuestas']['division'][$index] === $division->respuesta_correcta) ? $es_correcto = true : $es_correcto = false;

            Respuesta::create(
                [
                    'problema_id' => $division->id,
                    'respuesta' => $request['respuestas']['division'][$index],
                    'es_correcta' => $es_correcto
                ]
            );
        }

        $respuestas =
            DB::table('respuestas')
            ->join('problemas', 'respuestas.problema_id', '=', 'problemas.id')
            ->where('problemas.evaluacion_id', '=', $request->lastId)
            ->select('respuestas.respuesta', 'respuestas.es_correcta', 'respuestas.created_at', 'problemas.inciso', 'problemas.descripcion', 'problemas.operando_uno', 'problemas.operando_dos', 'problemas.respuesta_correcta', 'problemas.tipo')
            ->get();

        $evaluacion = Evaluacion::select('id', 'nombre', 'created_at')->where('id', $request->lastId)->first();


        $signedUrl = URL::signedRoute('get.pdf', ['id_evaluacion' => $evaluacion->id]);

        $path = 'evaluaciones/evaluacion_' . $evaluacion->id . '_' . Auth::user()->name . '.pdf';

        $pdf = PDF::loadView('mail.resultado_evaluacion', ['respuestas' => $respuestas, 'evaluacion' => $evaluacion, 'signedUrl' => $signedUrl]);
        $pdf->save(storage_path('app/' . $path));

        EvaluacionesHechas::create(
            [
                'user_id' => Auth::user()->id,
                'evaluacion_id' => $evaluacion->id,
                'pdf_path' => $path,
                'signed_url' => $signedUrl
            ]
        );

        Mail::to(Auth::user()->email)->send(new ResultadoEvaluacion($respuestas, $evaluacion, $signedUrl));

        return redirect('/')->with('success', 'Respuestas enviadas con éxito. Revisa tu bandeja de entrada de tu correo');
    }
}
