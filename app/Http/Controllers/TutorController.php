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
        return view('tutores.agenda');
    }

    public function agenda()
    {
        return view('tutores.agenda');
    }

    public function createEspacio()
    {
        $userId = Auth::id();

        $tutor = DB::select('SELECT * FROM tutors WHERE user_id = ?', [$userId]);

        if (empty($tutor)) {
            return redirect()->route('home')->with('error', 'No se encontró el tutor asociado a tu cuenta.');
        }

        return view('tutores.espacio_create', ['tutor' => $tutor[0]]);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect('/login'); 
    }
}
