<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    //

    public function nivel_Educativo($iiee_id,$nivel)
    {
        //

       return response()->json(Grado::where('iiee_id',$iiee_id)->where('nivel',$nivel)->get());
    }
}
