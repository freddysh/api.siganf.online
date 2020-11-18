<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    //
    public function index(){
        $departamentos=Departamento::get();
        // return $departamentos;
        // response()->json();

        return response()->json($departamentos);
    }
}
