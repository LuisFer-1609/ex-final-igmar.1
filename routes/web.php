<?php

use App\Http\Controllers\Evaluaciones;
use App\Http\Controllers\OperacionesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignedEvaluacion;
use App\Models\Problema;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use function Psy\bin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [OperacionesController::class, 'evaluacion'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/post-evaluacion', [OperacionesController::class, 'postEvaluacion'])->middleware(['auth', 'verified']);
Route::get('signed-url/{id_evaluacion}', [SignedEvaluacion::class, 'signedEvaluacion'])->middleware('signed')->name('get.pdf');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('resta', [Evaluaciones::class, 'resta']);
    Route::get('multiplicacion', [Evaluaciones::class, 'multiplicacion']);
    Route::get('division', [Evaluaciones::class, 'division']);
});

Route::get('mail', function () {
    return DB::table('respuestas')
        ->join('problemas', 'respuestas.problema_id', '=', 'problemas.id')
        ->where('problemas.evaluacion_id', '=', '1')
        ->select('respuestas.respuesta', 'respuestas.es_correcta', 'respuestas.created_at', 'problemas.inciso', 'problemas.descripcion', 'problemas.operando_uno', 'problemas.operando_dos', 'problemas.respuesta_correcta', 'problemas.tipo')
        ->get();
});

require __DIR__ . '/auth.php';
