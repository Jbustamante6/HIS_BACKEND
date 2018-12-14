<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lecturas;
use App\User;


class LecturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturas=Lecturas::all();
        return response($lecturas);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Lecturas::create($request->all());
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
        $lecturas=Lecturas::find($id);
        return response()->json($lecturas);
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
       $lecturas=Lecturas::find($id);
       $lecturas->fill($request->all());
       $lecturas->save();
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
        $lecturas=Lecturas::find($id);
        $lecturas->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
    
    public function endLecturas(Request $request){
        
        $user_id=User::resolveId();
        $lecturas=Lecturas::where('users_id', '=', $user_id)->where('estudios_id', '=', $request->estudios_id)->update(['hora_fn_lectura'=> $request->hora_fn_lectura]);
        return response(['mensaje'=>'Actualizado Correctamente', $lecturas]);
    }
}
