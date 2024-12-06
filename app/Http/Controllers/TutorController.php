<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    public function home()
    {
        $userId = Auth::id();
        $tutor = DB::select('SELECT * FROM tutores WHERE user_id = ?', [$userId])[0];

        $sqlEspacios = 'SELECT * FROM espacios WHERE tutor_id = ?';
        $espacios = DB::select($sqlEspacios, [$tutor->id]);
        return view('tutores.agenda')->with('espacios', $espacios);
    }

    public function agenda()
    {
        $userId = Auth::id();
        $tutor = DB::select('SELECT * FROM tutores WHERE user_id = ?', [$userId])[0];

        $sqlEspacios = 'SELECT * FROM espacios WHERE tutor_id = ?';
        $espacios = DB::select($sqlEspacios, [$tutor->id]);

        return view('tutores.agenda')->with('espacios', $espacios);
    }

    public function createEspacio()
    {
        $userId = Auth::id();
        $tutor = DB::select('SELECT * FROM tutores WHERE user_id = ?', [$userId]);

        if (empty($tutor)) {
            return redirect()->route('home')->with('error', 'No se encontró el tutor asociado a tu cuenta.');
        }

        return view('tutores.espacio_create', ['tutor' => $tutor[0]]);
    }

   

    public function logout()
    {
        Auth::logout(); 
        return redirect('/login'); 
    }

    public function vistaSaldo()
    {
        $userId = Auth::id();
        $tutor = DB::select('SELECT * FROM tutores WHERE user_id = ?', [$userId])[0];
        return view('tutores.saldo')->with('saldo', $tutor->saldo);
    }

    public function citas(){
        $userId = Auth::id();
        $tutor = DB::select('SELECT * FROM tutores WHERE user_id = ?', [$userId])[0];


        $citas = DB::select(
            '
            SELECT citas.*, estudiantes.telefono, estudiantes.correo, estudiantes.nombre 
            FROM citas 
            INNER JOIN estudiantes ON estudiantes.id = citas.estudiante_id
            WHERE citas.tutor_id = ?',
            [$tutor->id]
        );

        return view('tutores.citas')->with('citas', $citas);
    }
}
