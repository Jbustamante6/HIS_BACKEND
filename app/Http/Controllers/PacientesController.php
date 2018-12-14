<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacientes;
use Illuminate\Support\Facades\Crypt;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes=Pacientes::all();
        foreach($pacientes as $paciente){
            $paciente->nombres = Crypt::decrypt($paciente->nombres);
            $paciente->apellidos = Crypt::decrypt($paciente->apellidos);
            $paciente->n_ident = Crypt::decrypt($paciente->n_ident);
        }
        return response($pacientes);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Pacientes::create($request->all());
        $pacientes = new Pacientes();
        
        $pacientes->fill([
            'nombres' => Crypt::encrypt($request->nombres),
            'apellidos' => Crypt::encrypt($request->apellidos),
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'n_ident' => Crypt::encrypt($request->n_ident)
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
        $paciente=Pacientes::find($id);
        $paciente->nombres = Crypt::decrypt($paciente->nombres);
        $paciente->apellidos = Crypt::decrypt($paciente->apellidos);
        $paciente->n_ident = Crypt::decrypt($paciente->n_ident);
        return response()->json($paciente);
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
       $paciente=Pacientes::find($id);
       $paciente->fill([
            'nombres' => Crypt::encrypt($request->nombres),
            'apellidos' => Crypt::encrypt($request->apellidos),
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'n_ident' => Crypt::encrypt($request->n_ident)
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
        $paciente=Pacientes::find($id);
        $paciente->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
