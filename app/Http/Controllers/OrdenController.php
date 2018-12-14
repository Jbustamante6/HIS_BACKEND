<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use Illuminate\Support\Facades\Crypt;


class OrdenController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orden = Orden::join('eps', 'eps_id', '=', 'eps.id')
                      ->join('autorizacion', 'autorizacion_id', '=', 'autorizacion.id')
                      ->select('orden.*', 'autorizacion.numero as autorizacion_num', 'eps.num as eps_num', 'eps.nombre as eps_nombre')
                      ->get();
        foreach( $orden as $order){
            $order->num = Crypt::decrypt($order->num);
            $order->autorizacion_num = Crypt::decrypt($order->autorizacion_num);
            $order->eps_num = Crypt::decrypt($order->eps_num);
            $order->eps_nombre = Crypt::decrypt($order->eps_nombre);

           
        }
        return response($orden);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Orden::create($request->all());
        $orden = new Orden();
        $orden->fill([
            'num' => Crypt::encrypt($request->num),
            'eps_id' => $request->eps_id,
            'autorizacion_id' => $request->autorizacion_id
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
        $orden=Orden::where('orden.id', '=', $id)
                    ->join('eps', 'eps_id', '=', 'eps.id')
                    ->join('autorizacion', 'autorizacion_id', '=', 'autorizacion.id')
                    ->select('orden.*', 'autorizacion.numero as autorizacion_num', 'eps.num as eps_num', 'eps.nombre as eps_nombre')
                    ->get();
                    
        if(isset($orden[0])){
            $orden[0]->num = Crypt::decrypt($orden[0]->num);
            $orden[0]->autorizacion_num = Crypt::decrypt($orden[0]->autorizacion_num);
            $orden[0]->eps_num = Crypt::decrypt($orden[0]->eps_num);
            $orden[0]->eps_nombre = Crypt::decrypt($orden[0]->eps_nombre);
        }
        return response()->json($orden[0] ??  (object) array());
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
       $orden=Orden::find($id);
       $orden->fill([
            'num' => Crypt::encrypt($request->num),
            'eps_id' => $request->eps_id,
            'autorizacion_id' => $request->autorizacion_id
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
        $orden=Orden::find($id);
        $orden->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
}
