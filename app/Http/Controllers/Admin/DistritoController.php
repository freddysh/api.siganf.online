<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrito;
use App\Models\Ugel;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    //
    public function index($provincia_id){
         $objeto=Distrito::where('provincia_id',$provincia_id)->get();
        return response()->json($objeto);
    }
    public function show($id){
        $departamentos=Distrito::findorfail($id);
        // return $departamentos;
        // response()->json();

        return response()->json($departamentos);
    }
}
