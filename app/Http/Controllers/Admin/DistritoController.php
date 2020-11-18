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
        if($provincia_id<1000)
        $provincia_id='0'.$provincia_id;
        $objeto=Distrito::where('provincia_id',$provincia_id)->get();
        return response()->json($objeto);
    }

}
