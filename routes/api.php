<?php

use App\Http\Controllers\Admin\AcompananteController;
use App\Http\Controllers\Admin\AreaCurricularController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AsesoriaController;
use App\Http\Controllers\Admin\DiaController;
use App\Http\Controllers\Admin\DreController;
use App\Http\Controllers\Admin\GradoController;
use App\Http\Controllers\Admin\IieeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UgelController;
use App\Http\Controllers\Admin\DepartamentoController;
use App\Http\Controllers\Admin\DistritoController;
use App\Http\Controllers\Admin\ProvinciaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['cors']], function () {
Route::get('v1/login/{user}/{pw}',[LoginController::Class,'login']);
Route::get('v1/area-curricular/{nivel}',[AreaCurricularController::Class,'index']);
Route::get('v1/areas-curriculares',[AreaCurricularController::Class,'areas_curriculares']);
Route::get('v1/iiee',[IieeController::Class,'index_lista']);
Route::get('v1/iiee/{user_id}',[IieeController::Class,'index']);
Route::get('v1/iiee/{user_id}/{iiee_id}/docentes',[IieeController::Class,'docentes']);
Route::get('v1/iiee/{user_id}/{iiee_id}/grados',[IieeController::Class,'grados']);
Route::get('v1/ugel/{user_id}',[UgelController::Class,'index']);
Route::get('v1/dre',[DreController::Class,'index']);

Route::get('v1/asesoria/{id}',[AsesoriaController::Class,'asesoria']);
Route::get('v1/asesoria/{id}/delete',[AsesoriaController::Class,'destroy']);
Route::get('v1/asesoria/{id}/enviar',[AsesoriaController::Class,'enviara']);
Route::post('v1/asesoria',[AsesoriaController::Class,'filter']);
Route::post('v1/asesoria/store',[AsesoriaController::Class,'store']);
Route::post('v1/asesoria/store/constacia',[AsesoriaController::Class,'constacia']);

Route::post('v1/dia/store',[DiaController::Class,'store']);
Route::get('v1/dia/show/{dia_id}',[DiaController::Class,'index']);
Route::get('v1/dia/{id}/delete',[DiaController::Class,'destroy']);
Route::get('v1/grados/{iiee_id}/{nivel}',[GradoController::Class,'nivel_Educativo']);
Route::post('v1/grados/{iiee_id}/store',[GradoController::Class,'store']);
Route::put('v1/grados/{grado_id}/update',[GradoController::Class,'update']);
Route::get('v1/grados/{grado_id}/delete/ld',[GradoController::Class,'destroy']);

Route::get('v1/departamentos',[DepartamentoController::Class,'index']);
Route::get('v1/{departamento_id}/provincias/',[ProvinciaController::Class,'index']);
Route::get('v1/{provincia_id}/distritos/',[DistritoController::Class,'index']);

Route::get('v1/departamentos/{departamento_id}/show',[DepartamentoController::Class,'show']);
Route::get('v1/provincias/{provincia_id}/show',[ProvinciaController::Class,'show']);
Route::get('v1/distritos/{distrito_id}/show',[DistritoController::Class,'show']);

Route::post('v1/iiee/store',[IieeController::Class,'store']);
Route::put('v1/iiee/{iiee_id}/update',[IieeController::Class,'update']);
Route::get('v1/iiee/{iiee_id}/show',[IieeController::Class,'show']);
Route::get('v1/iiee/{iiee_id}/delete',[IieeController::Class,'destroy']);


Route::post('v1/iiee/{iiee_id}/docente/store',[IieeController::Class,'docente_store']);
Route::put('v1/iiee/{iiee_id}/docente/update',[IieeController::Class,'docente_update']);
Route::delete('v1/iiee/{docente_id}/docente/delete',[IieeController::Class,'docente_destroy']);


Route::get('v1/asesores',[AcompananteController::Class,'index']);
Route::get('v1/asesores/{asesor_id}/show',[AcompananteController::Class,'show']);
Route::post('v1/asesores/store',[AcompananteController::Class,'store']);
Route::put('v1/asesores/{asesor_id}/update',[AcompananteController::Class,'update']);
Route::get('v1/asesores/{asesor_id}/delete',[AcompananteController::Class,'destroy']);

Route::get('v1/asesores/{asesor_id}/iiees',[AcompananteController::Class,'iiee']);
Route::post('v1/asesores/{asesor_id}/iiees/store',[AcompananteController::Class,'iiee_store']);
Route::put('v1/asesores/{asesor_id}/iiees/update',[AcompananteController::Class,'iiee_update']);
Route::get('v1/asesores/asesor/iiees/{acompanante_id}/delete',[AcompananteController::Class,'iiee_destroy']);
});
