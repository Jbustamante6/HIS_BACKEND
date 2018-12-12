<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Birards;
use Illuminate\Support\Facades\Crypt;

class BirardsController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birards=Birards::all();
        return response($birards);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Birards::create($request->all());
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
        $birards=Birards::find($id);
        return response()->json($birards);
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
        $birard=Birards::find($id);
        $birard->fill($request->all());
        $birard->save();
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
        $birards=Birards::find($id);
        $birards->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
