<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acompanante;
use App\Models\Docente;
use App\Models\Grado;
use App\Models\Iiee;
use Illuminate\Http\Request;

class IieeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //
        $colegios=Acompanante::with(['iiee'])->where('user_id',$user_id)->get();

        //  return response()->json(Dre::get());
         return response()->json($colegios);
    }public function index_lista()
    {
        //
        $colegios=Iiee::get();

        //  return response()->json(Dre::get());
         return response()->json($colegios);
    }
    public function docentes($user_id,$iiee_id)
    {
        //
        $docentes=Docente::with(['iiee.grados','user'])->where('iiee_id',$iiee_id)->get();
        //  return response()->json(Dre::get());
         return response()->json($docentes);
    }
    public function grados($user_id,$iiee_id)
    {
        //
        $rpt=Grado::where('iiee_id',$iiee_id)->get();
        //  return response()->json(Dre::get());
         return response()->json($rpt);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            // return $request->all();
            $codigo_modular=$request->codigo_modular;
            $nombre=$request->nombre;
            $nivel=$request->nivel;
            $centro_poblado=$request->centro_poblado;
            $local=$request->local;
            $direccion=$request->direccion;
            $departamento=$request->departamento;
            $provincia=$request->provincia;
            $distrito=$request->distrito;
            $ugel_id=$request->ugel_id;

            $hay_ugel=Iiee::where('codigo_modular',$codigo_modular)
            ->where('nombre',$nombre)
            ->where('nivel',$nivel)
            ->where('departamento',$departamento)
            ->where('provincia',$provincia)
            ->where('distrito',$distrito)
            ->get()->count();
            if($hay_ugel==0){
            $objeto=new Iiee();
            $objeto->codigo_modular=$codigo_modular;
            $objeto->nombre=$nombre;
            $objeto->nivel=$nivel;
            $objeto->centro_poblado=$centro_poblado;
            $objeto->local=$local;
            $objeto->direccion=$direccion;
            $objeto->departamento=$departamento;
            $objeto->provincia=$provincia;
            $objeto->distrito=$distrito;
            $objeto->ugel_id=$ugel_id;
            return response()->json($objeto->save());
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            // return $request->all();
            $codigo_modular=$request->codigo_modular;
            $nombre=$request->nombre;
            $nivel=$request->nivel;
            $centro_poblado=$request->centro_poblado;
            $local=$request->local;
            $direccion=$request->direccion;
            $departamento=$request->departamento;
            $provincia=$request->provincia;
            $distrito=$request->distrito;
            $ugel_id=$request->ugel_id;

            $objeto= Iiee::findOrfail($id);
            $objeto->codigo_modular=$codigo_modular;
            $objeto->nombre=$nombre;
            $objeto->nivel=$nivel;
            $objeto->centro_poblado=$centro_poblado;
            $objeto->local=$local;
            $objeto->direccion=$direccion;
            $objeto->departamento=$departamento;
            $objeto->provincia=$provincia;
            $objeto->distrito=$distrito;
            $objeto->ugel_id=$ugel_id;
            return response()->json($objeto->save());

            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
