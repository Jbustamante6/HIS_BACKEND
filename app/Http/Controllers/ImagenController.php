<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imagen;
class ImagenController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagen=Imagen::all();
        return response($imagen);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Imagen::create($request->all());
        $imagen = new Imagen();
        $file = $request->file('img');
        if(isset($file)){	
            $imgString = base64_encode(file_get_contents($file));
            $imagen->fill(['img' => $imgString])->save();
        }
        
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
        $imagen=Imagen::find($id);
        return response()->json($imagen);
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
        $imagen=Imagen::find($id);
        $file = $request->file('img');
        if(isset($file)){	
            $imgString = base64_encode(file_get_contents($request->file('img')));
            $imagen->fill(['img' => $imgString])->save();
        }
        
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
        $imagen=Imagen::find($id);
        $imagen->delete();
        return response(['mensaje'=>'Eliminado Correctamente']);
    }
    
    public function updated(Request $request, $id)
    {
        $imagen=Imagen::find($id);
        $file = $request->file('img');

        if(isset($file)){	
            $imgString = base64_encode(file_get_contents($file));
            $imagen->fill(['img' => $imgString])->save();
        }
        
        return response(['mensaje'=>'Actualizado Correctamente']);
    }
}
