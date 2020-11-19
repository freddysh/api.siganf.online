<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acompanante;
use App\Models\User;
use Illuminate\Http\Request;

class AcompananteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto=User::where('rol','acompanante')->get();
        return response()->json($objeto);
    }
    public function iiee($asesor_id)
    {
        //
        $objeto=Acompanante::with(['iiee'])->where('user_id',$asesor_id)->get();
        // $objeto=User::where('rol','acompanante')->get();
        return response()->json($objeto);
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
            $dni=$request->dni;
            $nombre=$request->nombre;
            $email=$request->email;
            $password=$request->password;
            $existe=User::where('dni',$dni)->where('email',$email)->get()->count();
            if(!$existe){
                $objeto=new User();
                $objeto->dni=$dni;
                $objeto->rol='acompanante';
                $objeto->name=$nombre;
                $objeto->email=$email;
                $objeto->password=$password;
                $objeto->save();
                return response()->json($objeto);
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
    public function iiee_store(Request $request,$asesor_id)
    {
        //
        try {
            $iiee_id=$request->iiee_id;

            $existe= Acompanante::where('iiee_id',$iiee_id)->where('user_id',$asesor_id)->get()->count();
            if(!$existe){
                $objeto=new Acompanante();
                $objeto->iiee_id=$iiee_id;
                $objeto->user_id=$asesor_id;
                $objeto->save();
                $nuevo_objeto=Acompanante::with(['iiee'])->where('id',$objeto->id)->get()->first();
                return response()->json($nuevo_objeto);
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
        $objeto=User::findorfail($id);
        return response()->json($objeto);
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
            $dni=$request->dni;
            $nombre=$request->nombre;
            $email=$request->email;
            $password=$request->password;
            $objeto=User::findorfail($id);
            $objeto->dni=$dni;
            $objeto->name=$nombre;
            $objeto->email=$email;
            $objeto->password=$password;
            $objeto->save();
            return response()->json($objeto);

            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
    public function iiee_update(Request $request, $asesor_id)
    {
        //
        try {
            $iiee_id=$request->iiee_id;
            $id=$request->id;

            $objeto=Acompanante::findOrfail($id);
            $objeto->iiee_id=$iiee_id;
            $objeto->save();
            $nuevo_objeto=Acompanante::with(['iiee'])->where('id',$id)->get()->first();
            return response()->json($nuevo_objeto);
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

        $objeto=User::findorfail($id);

        return response()->json($objeto->delete());
    }
    public function iiee_destroy($id)
    {
        //

        $objeto=Acompanante::findorfail($id);

        return response()->json($objeto->delete());
    }
}
