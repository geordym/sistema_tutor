<?php

namespace App\Http\Controllers;

use App\Models\Espacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspacioController extends Controller
{
    //

    public function listarEspaciosPorTutorYFecha(Request $request)
    {
        // Obtener los parámetros del request
        $tutorId = $request->input('tutor_id');
        $fecha = $request->input('fecha');
    
        // Validación de los parámetros
        $validator = Validator::make($request->all(), [
            'tutor_id' => 'required|exists:tutores,id', // Validar que el tutor exista en la tabla 'tutores'
            'fecha' => 'required|date', // Validar que la fecha sea válida
        ]);
    
        // Si la validación falla, devolver los errores en formato JSON
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422); // 422 es el código HTTP para validaciones fallidas
        }
    
        // Consultar los espacios para el tutor en la fecha especificada
        $espacios = Espacio::where('tutor_id', $tutorId)
                           ->where('fecha', $fecha)
                           ->get();
    
        // Verificar si existen espacios
        if ($espacios->isEmpty()) {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron espacios para este tutor en la fecha indicada.'
            ], 404); // 404 es el código HTTP para "No encontrado"
        }
    
        // Retornar los espacios encontrados en formato JSON
        return response()->json([
            'error' => false,
            'message' => 'Espacios encontrados.',
            'data' => $espacios
        ], 200); // 200 es el código HTTP para éxito
    }
    

    public function store(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'tutor' => 'required|exists:tutores,id', // Validar que el tutor exista en la tabla 'tutores'
            'fecha' => 'required|date', // Validar que la fecha sea válida
            'hora_inicio' => 'required|date_format:H:i', // Validar que la hora de inicio esté en el formato correcto
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio', // Validar que la hora de fin sea posterior a la hora de inicio
        ]);
    
        if ($validator->fails()) {
            return back() // Regresa a la página anterior
                ->withErrors($validator) // Incluye los errores de validación
                ->withInput(); // Retorna los datos ingresados
        }
    
        // Obtener los valores del request
        $tutor_id = $request->input('tutor');
        $fecha = $request->input('fecha');
        $hora_inicio = $request->input('hora_inicio');
        $hora_fin = $request->input('hora_fin');
    
        // Convertir las horas de inicio y fin a objetos Carbon para poder manipularlos
        $hora_inicio = \Carbon\Carbon::createFromFormat('H:i', $hora_inicio);
        $hora_fin = \Carbon\Carbon::createFromFormat('H:i', $hora_fin);
    
        // Verificar que la duración del espacio sea de al menos una hora
        if ($hora_inicio->diffInMinutes($hora_fin) < 60) {
            return back()->with('error', 'El espacio debe durar al menos una hora.');
        }
    
        // Verificar si ya existe un espacio para el mismo tutor en el mismo intervalo de tiempo
        $existeEspacio = Espacio::where('tutor_id', $tutor_id)
                                ->where('fecha', $fecha)
                                ->where(function($query) use ($hora_inicio, $hora_fin) {
                                    $query->whereBetween('hora_inicio', [$hora_inicio, $hora_fin])
                                          ->orWhereBetween('hora_fin', [$hora_inicio, $hora_fin])
                                          ->orWhere(function($query) use ($hora_inicio, $hora_fin) {
                                              $query->where('hora_inicio', '<', $hora_inicio)
                                                    ->where('hora_fin', '>', $hora_fin);
                                          });
                                })
                                ->exists();
    
        // Si ya existe un espacio en el mismo intervalo, devolver un error
        if ($existeEspacio) {
            return back()->with('error', 'Ya existe un espacio agendado en este intervalo de tiempo.');
        }
    
        // Crear el espacio
        $espacio = new Espacio();
        $espacio->titulo = "Espacio libre";
        $espacio->fecha = $fecha;
        $espacio->hora_inicio = $hora_inicio->format('H:i');
        $espacio->hora_fin = $hora_fin->format('H:i');
        $espacio->tutor_id = $tutor_id;
        $espacio->save();
    
        // Retornar respuesta de éxito
        return back()->with('success', 'Espacio agendado correctamente');
    }
    
    


}
