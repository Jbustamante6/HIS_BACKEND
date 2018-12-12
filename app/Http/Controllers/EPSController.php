<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EPS;
use Illuminate\Support\Facades\Crypt;

class EPSController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eps=EPS::all();
        foreach($eps as $ep){
            
            $ep->nombre = Crypt::decrypt($ep->nombre);
            $ep->num = Crypt::decrypt($ep->num);
        }
        return response($eps);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eps = new EPS();
        $eps->fill([
            'nombre' => Crypt::encrypt($request->nombre),
            'num' => Crypt::encrypt($request->num)
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
        $eps=EPS::find($id);
        $eps->nombre = Crypt::decrypt($eps->nombre);
        $eps->num = Crypt::decrypt($eps->num);
        return response()->json($eps);
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
        $eps=EPS::find($id);
        $eps->fill([
            'nombre' => Crypt::encrypt($request->nombre),
            'num' => Crypt::encrypt($request->num)
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
        $eps=EPS::find($id);
        $eps->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }}
