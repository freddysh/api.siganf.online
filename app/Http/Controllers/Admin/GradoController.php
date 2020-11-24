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
// return "_$iiee_id,$nivel";
       return response()->json(Grado::where('iiee_id',$iiee_id)->where('nivel',$nivel)->get());
    }
    public function store(Request $request,$iiee_id)
    {
        //
        try {
            $nivel=$request->nivel;
            $nombre=$request->nombre;
            $objeto=new Grado();
            $objeto->nivel=$nivel;
            $objeto->nombre=$nombre;
            $objeto->iiee_id=$iiee_id;
            return response()->json($objeto->save());
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
    public function update(Request $request, $id)
    {
        //
        try {
            // return $request->all();
            $nivel=$request->nivel;
            $nombre=$request->nombre;

            $objeto= Grado::findOrfail($id);
            $objeto->nivel=$nivel;
            $objeto->nombre=$nombre;
            return response()->json($objeto->save());

            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
    public function destroy($id)
    {
        //
        // return 'hola';
        $objeto= Grado::findOrfail($id);
        return response()->json($objeto->delete());
    }
}
