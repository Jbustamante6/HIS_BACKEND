<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BirardsEstudios;
class BirardsEstudiosController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birardsEstudios=BirardsEstudios::all();
        return response($birardsEstudios);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BirardsEstudios::create($request->all());
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
        $birardsEstudios=BirardsEstudios::find($id);
        return response()->json($birardsEstudios);
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
       $birardsEstudios=BirardsEstudios::find($id);
       $birardsEstudios->fill($request->all());
       $birardsEstudios->save();
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
        $birardsEstudios=BirardsEstudios::find($id);
        $birardsEstudios->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
