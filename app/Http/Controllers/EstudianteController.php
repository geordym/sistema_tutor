<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{

    public function home()
    {
        return view('estudiantes.home');
    }

    public function citas()
    {
        // Obtener el ID del usuario autenticado
        $user = auth()->user();

        // Consulta SQL para obtener el estudiante
        $estudiante = DB::select('SELECT * FROM estudiantes WHERE user_id = ?', [$user->id]);

        // Si no se encuentra el estudiante, retornar una respuesta adecuada
        if (empty($estudiante)) {
            return redirect()->route('home')->with('error', 'Estudiante no encontrado');
        }

        // Obtener las citas del estudiante
        $citas = DB::select(
            '
            SELECT citas.*, tutores.telefono, tutores.correo, tutores.nombre 
            FROM citas 
            INNER JOIN tutores ON tutores.id = citas.tutor_id
            WHERE citas.estudiante_id = ?',
            [$estudiante[0]->id]
        );
        

        // Pasar las citas a la vista
        return view('estudiantes.citas', ['citas' => $citas]);
    }
}
