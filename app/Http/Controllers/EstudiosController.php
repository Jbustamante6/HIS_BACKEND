<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudios;
use App\BirardsEstudios;
use App\Birards;
use App\Lecturas;
use App\User;
use Carbon\Carbon;
use DB;

use Illuminate\Support\Facades\Crypt;

class EstudiosController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudios=Estudios::where('estados_estudio_id', '=', 1 )->with('modalidad','estadosEstudio')->get();
        foreach($estudios as $estudio){
            $estudio->informacion = Crypt::decrypt($estudio->informacion);
        }

        return response($estudios);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Estudios::create($request->all());
        $estudio = new Estudios();
        $estudio->fill([
            'informacion' => Crypt::encrypt($request->informacion),
            'estados_estudio_id' => 1,
            'pacientes_id' => $request->pacientes_id,
            'modalidad_id' => $request->modalidad_id,
            'imagen_id' => $request->imagen_id,
            'orden_id' => $request->orden_id
            
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
        $estudios=Estudios::join('pacientes', 'pacientes.id', '=', 'estudios.pacientes_id')
                          ->join('imagen', 'imagen.id', '=', 'estudios.imagen_id')
                          ->join('modalidad', 'modalidad.id', '=', 'estudios.modalidad_id')
                          ->where('estudios.id', '=', $id)
                          ->select(
                              'estudios.*',
                              'pacientes.nombres as pacienteNombres', 
                              'pacientes.apellidos as pacienteApellidos', 
                              'pacientes.fecha_nacimiento as pacienteNacimiento', 
                              'modalidad.nombre as modalidad', 
                              'imagen.img as imagen')
                          ->get();
        if(isset($estudios[0])){
            $estudios[0]->informacion=Crypt::decrypt($estudios[0]->informacion);
            $estudios[0]->pacienteNombres=Crypt::decrypt($estudios[0]->pacienteNombres);
            $estudios[0]->pacienteApellidos=Crypt::decrypt($estudios[0]->pacienteApellidos);
            if(isset($estudios[0]->hallazgo)){
                $estudios[0]->hallazgo=Crypt::decrypt($estudios[0]->hallazgo);
            }

        }
        //$birards=Birards::all();
        
        return response($estudios);
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
        $estudio=Estudios::find($id);
        //$estudios->fill($request->all());
        $estudio->fill([
            'estados_estudio_id' => 2,
            'intensidad_media' => $request->intensidad_media,
            'vol_agua' => $request->vol_agua,
            'vol_total' => $request->vol_total,
            'hallazgo' => Crypt::encrypt($request->hallazgo),
        ])->save();
        
        //arreglo de IDs
        $birards = $request->birards;
       
        foreach($birards as $bir){
            BirardsEstudios::create([
                'birards_id' => $bir,
                'estudios_id' => $estudio->id
            ]);
        }
        
        $user_id=User::resolveId();
        $hoy = Carbon::now();
        $fecha = $hoy->format('Y-m-d');
        $horaInicio = $hoy->format('H:i:s');
        
        Lecturas::create([
            'users_id' => $user_id,
            'estudios_id' => $estudio->id,
            'fecha_lectura' => $fecha,
            'hora_in_lectura' => $horaInicio
        ]);
        
       
        $estudio->save();
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
        $estudios=Estudios::find($id);
        $estudios->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
    
    public function estadisticas(Request $request){
        $modalidades = implode(",", $request->modalidades);
        $datos=DB::select('Call estadistica(?, ?, ?)',array($modalidades, $request->fecha_ini, $request->fecha_fin));
        return response(['datos'=>$datos]);
    }
    
    public function esdtudioCientifico(Request $request){
        
        
        $hoy=Carbon::now();
        $min = $hoy->subYear($request->edadMin);
        $hoy=Carbon::now();
        $max = $hoy->subYear($request->edadMax);
        
       // return response([$min, $max]);

        $datos = DB::select('Call estudiosCientificos(?, ?, ?)',array($request->birards, $max->year, $min->year));
        return response($datos);
        
    }
}
