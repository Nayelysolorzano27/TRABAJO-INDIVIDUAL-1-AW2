<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paralelo;
use Illuminate\Support\Facades\Log;

class ParaleloController extends Controller
{
    /**
     * Mostrar todos los paralelos
     */
    public function index()
    {
        return Paralelo::all();
    }
    
    /**
     * Guardar un nuevo paralelo.
     */
    public function store(Request $request)
    {
        Log::info('Datos que llegan en la peticion', $request->all());
        $request->validate([
            'nombre' => 'required|string|max:20|unique:paralelos'
        ]);

        $paralelo = Paralelo::create($request->all());
        Log::info('Paralelo creado con ID'. $paralelo->id);
        //
        return response()->json([
            'mensaje' => 'Paralelo creado exitosamente',
            'paralelo' => $request->all()
        ],200);
    }

    /**
     * Mostrar un paralelo especifico.
     */
    public function show($id)
    {
        Log::info('INICIANDO UNA SOLICITUD DE CONSULTA CON ID');
        $paralelo = Paralelo::find($id);
        
        if(!$paralelo){
            //Log::info('No se encontro registro para ID:', $id);
            return response()->json(['mensaje'=> 'Paralelo no encontrado'],420);
        }
        Log::info('DATOS ENCONTRADOS:');

        return $paralelo;
    }
    
    /**
     * Actualizar un paralelo exitente.
     */
    public function update(Request $request, $id)
    {
        $paralelo = Paralelo::find($id);
        
        if (!$paralelo){
            return response()->json(['mensaje'=>'Paralelo no encontrado'],420);
        }

        $request->validate([
            'nombre' => 'required|string|max:100|unique:paralelos,nombre,'. $id,
        ]);

        $paralelo->update($request->all());

        return response()->json([
            'mensaje' => 'Paralelo actualizado correctamente',
            'paralelo' => $paralelo
        ]);
    }

    /**
     * Eliminar un paralelo.
     */
    public function destroy ($id)
    {
        $paralelo = Paralelo::find($id);

        if (!$paralelo){
            return response()->json(['mensaje' => 'Paralelo no encontrado'],404);
        }

        $paralelo->delete();
        
        return response()->json(['mensaje' => 'Paralelo eliminado correctamente']);
    }
}