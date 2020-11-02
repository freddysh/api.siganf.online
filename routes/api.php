<?php

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
Route::get('v1/iiee/{user_id}',[IieeController::Class,'index']);
Route::get('v1/iiee/{user_id}/{iiee_id}/docentes',[IieeController::Class,'docentes']);
Route::get('v1/iiee/{user_id}/{iiee_id}/grados',[IieeController::Class,'grados']);
Route::get('v1/ugel/{user_id}',[UgelController::Class,'index']);
Route::get('v1/dre',[DreController::Class,'index']);

Route::get('v1/asesoria/{id}',[AsesoriaController::Class,'asesoria']);
Route::get('v1/asesoria/{id}/delete',[AsesoriaController::Class,'destroy']);
Route::post('v1/asesoria',[AsesoriaController::Class,'filter']);
Route::post('v1/asesoria/store',[AsesoriaController::Class,'store']);
Route::post('v1/asesoria/store/constacia',[AsesoriaController::Class,'constacia']);

Route::post('v1/dia/store',[DiaController::Class,'store']);
Route::get('v1/dia/show/{dia_id}',[DiaController::Class,'index']);
Route::get('v1/dia/{id}/delete',[DiaController::Class,'destroy']);
Route::get('v1/grados/{iiee_id}/{nivel}',[GradoController::Class,'nivel_Educativo']);

});
