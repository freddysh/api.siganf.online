<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaCurricular;
use App\Models\Competencia;
use App\Models\Criterio;
use App\Models\Dia;
use App\Models\DiaAreaCurricular;
use App\Models\DiaGrado;
use App\Models\Grado;
use App\Models\Iiee;
use App\Models\P_18;
use Exception;
use Illuminate\Http\Request;

class DiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($dia_id)
    {
        // Devuelve el dia a editar(se enviara todo los datos de ese dia)
        $editDia= Dia::with(['grados','areaCurriculares','p_18','competencias','criterios'])
        ->where('id',$dia_id)->get();
        return response()->json($editDia);
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

        $dia_id=$request->dia_id;
        $dia=$request->dia_;
        $fecha=$request->fecha;
        $hora_inicio=$request->hora_inicio;
        $hora_fin=$request->hora_fin;
        $medio_virtual=$request->medio_virtual||'';;
        $medio_virtual_otros=$request->medio_virtual_otros||'';
        $nivel_educativo=$request->nivel_educativo;
        $p_16=$request->p_16;
        $p_17=$request->p_17||0;
        $obs_p_17=$request->obs_p_17||'';
        $p_18=$request->p_18;
        $obs_p_18=$request->obs_p_18||'';
        $p_19=$request->p_19||'';
        $obs_p_19=$request->obs_p_19||'';
        $p_20=$request->p_20||'';
        $obs_p_20=$request->obs_p_20||'';
        $asesoria_id=$request->asesoria_id;
        $grados=$request->grados;
        $areas_curriculares=$request->area_curricular;
        $competencias_=$request->competencias_;
        $criterios_=$request->criterios_;

        if($dia_id==0||$dia_id==null){//  TODO: creamos uno nuevo
            // TODO: Agregamos el dia
            $nuevoDia=new Dia();
            $nuevoDia->dia=$dia;
            $nuevoDia->fecha=$fecha;
            $nuevoDia->hora_inicio=$hora_inicio;
            $nuevoDia->hora_fin=$hora_fin;
            $nuevoDia->medio_virtual=$medio_virtual;
            $nuevoDia->medio_virtual_otros=$medio_virtual_otros;
            $nuevoDia->nivel_educativo=$nivel_educativo;
            $nuevoDia->p_16=$p_16;
            $nuevoDia->p_17=$p_17;
            $nuevoDia->obs_p_17=$obs_p_17;
            $nuevoDia->obs_p_18=$obs_p_18;
            $nuevoDia->p_19=$p_19;
            $nuevoDia->obs_p_19=$obs_p_19;
            $nuevoDia->p_20=$p_20;
            $nuevoDia->obs_p_20=$obs_p_20;
            $nuevoDia->asesoria_id=$asesoria_id;

            if($nuevoDia->save()){
                //TODO: Agregamos los grados
                foreach($grados as $grado_){
                    $grado=new DiaGrado();
                    $grado->grado_id=$grado_;
                    $grado->nombre=Grado::findorfail($grado_)->nombre;
                    $grado->dia_id=$nuevoDia->id;
                    $grado->save();
                }
                //TODO: agregamos las areas curriculares
                foreach($areas_curriculares as $area_curricular_){
                    $areaCurricular=new DiaAreaCurricular();
                    $areaCurricular->nivel=AreaCurricular::findorfail($area_curricular_)->nivel;
                    $areaCurricular->nombre=AreaCurricular::findorfail($area_curricular_)->nombre;
                    $areaCurricular->detalle='';
                    $areaCurricular->estado=1;
                    $areaCurricular->area_curricular_id=$area_curricular_;
                    $areaCurricular->dia_id=$nuevoDia->id;
                    $areaCurricular->save();
                }

                //TODO: agregamos las competencias
                foreach($competencias_ as $competencia_){
                    $objeto=new Competencia();
                    $objeto->competencia=$competencia_['competencia'];
                    $objeto->eje=$competencia_['eje'];
                    $objeto->dimension=$competencia_['dimension'];
                    $objeto->criterio=$competencia_['criterio'];
                    $objeto->aspecto=$competencia_['aspecto'];
                    $objeto->opcion=1;
                    $objeto->compromiso=$competencia_['compromiso'];
                    $objeto->dia_id=$nuevoDia->id;
                    $objeto->save();
                }
                //TODO: agregamos los criterios
                foreach($criterios_ as $criterio_){
                    $objeto=new Criterio();
                    $objeto->aspecto=$criterio_['aspecto'];
                    $objeto->criterio=$criterio_['criterio'];
                    $objeto->opcion=$criterio_['opcion'];
                    $objeto->opcion_1=$criterio_['opcion_1'];
                    $objeto->opcion_2=$criterio_['opcion_2'];
                    $objeto->opcion_3=$criterio_['opcion_3'];
                    $objeto->opcion_4=$criterio_['opcion_4'];
                    $objeto->observacion=$criterio_['observacion'];
                    $objeto->dia_id=$nuevoDia->id;
                    $objeto->save();
                }
                //TODO: agregamos p_18
                foreach($p_18 as $p_18_){
                    $objeto=new P_18();
                    $objeto->opcion=$p_18_;
                    $objeto->dia_id=$nuevoDia->id;
                    $objeto->save();
                }
                return response()->json(true);
            }
            else
                return response()->json(false);
        }
        elseif($dia_id>0){
            $editDia= Dia::findorfail($dia_id);
            $editDia->dia=$dia;
            $editDia->fecha=$fecha;
            $editDia->hora_inicio=$hora_inicio;
            $editDia->hora_fin=$hora_fin;
            $editDia->medio_virtual=$medio_virtual;
            $editDia->medio_virtual_otros=$medio_virtual_otros;
            $editDia->nivel_educativo=$nivel_educativo;
            $editDia->p_16=$p_16;
            $editDia->p_17=$p_17;
            $editDia->obs_p_17=$obs_p_17;
            $editDia->obs_p_18=$obs_p_18;
            $editDia->p_19=$p_19;
            $editDia->obs_p_19=$obs_p_19;
            $editDia->p_20=$p_20;
            $editDia->obs_p_20=$obs_p_20;
            $editDia->asesoria_id=$asesoria_id;
            if($editDia->save()){
                //TODO: Agregamos los grados
                // antes borramos lo que se abia agregado
                $gradosAntiguos=  DiaGrado::where('dia_id',$dia_id)->delete();
                foreach($grados as $grado_){
                    $grado=new DiaGrado();
                    $grado->grado_id=$grado_;
                    $grado->nombre=Grado::findorfail($grado_)->nombre;
                    $grado->dia_id=$editDia->id;
                    $grado->save();
                }
                //TODO: agregamos las areas curriculares
                // antes borramos lo que se abia agregado
                $areasCurricularesAntiguos=  DiaAreaCurricular::where('dia_id',$dia_id)->delete();
                foreach($areas_curriculares as $area_curricular_){
                    $areaCurricular=new DiaAreaCurricular();
                    $areaCurricular->nivel=AreaCurricular::findorfail($area_curricular_)->nivel;
                    $areaCurricular->nombre=AreaCurricular::findorfail($area_curricular_)->nombre;
                    $areaCurricular->detalle='';
                    $areaCurricular->estado=1;
                    $areaCurricular->area_curricular_id=$area_curricular_;
                    $areaCurricular->dia_id=$editDia->id;
                    $areaCurricular->save();
                }

                //TODO: agregamos las competencias
                // antes borramos lo que se abia agregado
                $competenciasAntiguos=  Competencia::where('dia_id',$dia_id)->delete();
                foreach($competencias_ as $competencia_){
                    $objeto=new Competencia();
                    $objeto->competencia=$competencia_['competencia'];
                    $objeto->eje=$competencia_['eje'];
                    $objeto->dimension=$competencia_['dimension'];
                    $objeto->criterio=$competencia_['criterio'];
                    $objeto->aspecto=$competencia_['aspecto'];
                    $objeto->opcion=1;
                    $objeto->compromiso=$competencia_['compromiso'];
                    $objeto->dia_id=$editDia->id;
                    $objeto->save();
                }
                //TODO: agregamos los criterios
                // antes borramos lo que se abia agregado
                $competenciasAntiguos=  Criterio::where('dia_id',$dia_id)->delete();
                foreach($criterios_ as $criterio_){
                    $objeto=new Criterio();
                    $objeto->aspecto=$criterio_['aspecto'];
                    $objeto->criterio=$criterio_['criterio'];
                    $objeto->opcion=$criterio_['opcion'];
                    $objeto->opcion_1=$criterio_['opcion_1'];
                    $objeto->opcion_2=$criterio_['opcion_2'];
                    $objeto->opcion_3=$criterio_['opcion_3'];
                    $objeto->opcion_4=$criterio_['opcion_4'];
                    $objeto->observacion=$criterio_['observacion'];
                    $objeto->dia_id=$editDia->id;
                    $objeto->save();
                }
                //TODO: agregamos p_18
                // antes borramos lo que se abia agregado
                $competenciasAntiguos=  P_18::where('dia_id',$dia_id)->delete();
                foreach($p_18 as $p_18_){
                    $objeto=new P_18();
                    $objeto->opcion=$p_18_;
                    $objeto->dia_id=$editDia->id;
                    $objeto->save();
                }
                return response()->json(true);
            }
            else
                return response()->json(false);
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
        try{
            // borramos todos los datos
            $dia=Dia::findOrfail($id);
            // listamos los dias agregados
            if($dia->delete())
                return response()->json(true);
            else
                return response()->json(false);
        }
        catch(Exception $ex){
            return $ex;
        }
    }
}
