<?php

namespace App\Http\Controllers;

use App\Models\Espacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EspacioController extends Controller
{

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

        // Verificar que la duración del espacio sea de al menos una hora
        $hora_inicio_obj = \Carbon\Carbon::createFromFormat('H:i', $hora_inicio);
        $hora_fin_obj = \Carbon\Carbon::createFromFormat('H:i', $hora_fin);

        if ($hora_inicio_obj->diffInMinutes($hora_fin_obj) < 60) {
            return back()->with('error', 'El espacio debe durar al menos una hora.');
        }

        $sql = "
        SELECT COUNT(*) as count
        FROM espacios
        WHERE tutor_id = :tutor_id
        AND fecha = :fecha
        AND (
            (hora_inicio BETWEEN :hora_inicio AND :hora_fin)
        )
    ";

        $result = DB::select($sql, [
            'tutor_id' => $tutor_id,
            'fecha' => $fecha,
            'hora_inicio' => $hora_inicio,
            'hora_fin' => $hora_fin,
        ]);


        if ($result[0]->count > 0) {
            return back()->with('error', 'Ya existe un espacio agendado en este intervalo de tiempo.');
        }

        // Crear el espacio
        $sqlInsert = "
            INSERT INTO espacios (titulo, fecha, hora_inicio, hora_fin, tutor_id)
            VALUES ('Espacio libre', :fecha, :hora_inicio, :hora_fin, :tutor_id)
        ";

        DB::insert($sqlInsert, [
            'fecha' => $fecha,
            'hora_inicio' => $hora_inicio,
            'hora_fin' => $hora_fin,
            'tutor_id' => $tutor_id,
        ]);

        // Retornar respuesta de éxito
        return back()->with('success', 'Espacio agendado correctamente');
    }
}
