<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asesoria;
use App\Models\Dre;
use App\Models\Iiee;
use App\Models\Ugel;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class AsesoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //
        // return response()->json($user_id);
        $colegios=Iiee::with(['acompanante'],function($query)use($user_id){
            $query->where('user_id',$user_id);
        })->get();

        //  return response()->json(Dre::get());
         return response()->json($colegios);
    }
    public function asesoria($asesoria_id)
    {
        //
        // return response()->json($user_id);
        $asesoria=Asesoria::with(['dias','docente','iiee'])->where('id',$asesoria_id)->get();

        //  return response()->json(Dre::get());
         return response()->json($asesoria);
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
// return $request->all();
        $constancia_nro=1;
        $ultima_asesoria=Asesoria::all()
        ->sortByDesc('id')
        ->take(1);
        if(count($ultima_asesoria)>0)
            $constancia_nro=$ultima_asesoria->first()->constancia_nro+1;

        $fecha=explode('-',$request->fecha_envio);
        $anio=$request->anio;
        $mes=$request->mes;
        $fecha_envio= $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        $estado=$request->estado;
        $hay_visita=$request->hay_visita;
        $user_id=$request->acompanante_id;
        $iiee_id=$request->iiee_id;
        $docente_id=$request->docente_id;
        $asesoria=new Asesoria();
        $asesoria->anio=$anio;
        $asesoria->mes=$mes;
        $asesoria->constancia_nro=$constancia_nro;
        $asesoria->fecha_envio=$fecha_envio;
        $asesoria->estado=$estado;
        $asesoria->hay_visita=$hay_visita;
        $asesoria->user_id=$user_id;
        $asesoria->iiee_id=$iiee_id;
        $asesoria->docente_id=$docente_id;
        if($asesoria->save()){
            return $asesoria->id;
        }else
            return 0;


    }
    public function filter(Request $request)
    {
        //
        $anio=$request->anio;
        $mes=$request->mes;
        $estado=$request->estado;
        $acompanante_id=$request->acompanante_id;
        $iiee_id=$request->iiee_id;
// return "anio:$anio, mes:$mes,estado:$estado, acompanante:$acompanante_id, iiee:$iiee_id";
        $asesoria=Asesoria::with(['dias','docente','iiee'])
        ->where('anio',$anio)
        ->where('mes',$mes)
        ->where('estado',$estado)
        ->where('user_id',$acompanante_id)
        ->where('iiee_id',$iiee_id)
        ->get();

        return response()->json($asesoria);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            // borramos todos los datos
            $asesoria=Asesoria::findOrfail($id);
            // listamos los dias agregados
            if($asesoria->delete())
                return response()->json(true);
            else
                return response()->json(false);
        }
        catch(Exception $ex){
            return $ex;
        }
    }
}
