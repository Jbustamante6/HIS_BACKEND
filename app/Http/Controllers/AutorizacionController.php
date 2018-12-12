<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autorizacion;
use Illuminate\Support\Facades\Crypt;


class AutorizacionController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autorizacion=Autorizacion::all();
        foreach($autorizacion as $auto){
            $auto->numero = Crypt::decrypt($auto->numero);
        }
        return response($autorizacion);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $autorizacion = new Autorizacion();
        $autorizacion->fill([
            'numero' => Crypt::encrypt($request->numero)
        ])->save();
        return response(['mensaje'=>'Creado Correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autorizacion=Autorizacion::find($id);
        $autorizacion->numero = Crypt::decrypt($autorizacion->numero);
        return response()->json($autorizacion);
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
       $autorizacion=Autorizacion::find($id);
        $autorizacion->fill([
            'numero' => Crypt::encrypt($request->numero)
        ])->save();
       return response(['mensaje'=>'Actualizado Correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autorizacion=Autorizacion::find($id);
        $autorizacion->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
