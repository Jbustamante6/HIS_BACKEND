<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EstadosEstudio;

class EstadoEstudioController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadoEstudio=EstadosEstudio::all();
        return response($estadoEstudio);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EstadosEstudio::create($request->all());
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
        $estadoEstudio=EstadosEstudio::find($id);
        return response()->json($estadoEstudio);
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
       $estadoEstudio=EstadosEstudio::find($id);
       $estadoEstudio->fill($request->all());
       $estadoEstudio->save();
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
        $estadoEstudio=EstadosEstudio::find($id);
        $estadoEstudio->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }}
