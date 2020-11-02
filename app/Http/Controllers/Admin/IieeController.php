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
    }
}
