<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    //
    public function index($departamento_id){
        if($departamento_id<10)
        $departamento_id='0'.$departamento_id;
        $objeto=Provincia::where('departamento_id',$departamento_id)->get();
        return response()->json($objeto);
    }
}
