<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserType;

use App\Http\Controllers\Services\CollaboratorService;


use App\Models\Collaborator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //

    protected $collaboratorService;

    public function __construct(CollaboratorService $collaboratorService)
    {
        $this->collaboratorService = $collaboratorService;
    }

    public function index()
    {
        return view('home'); // Asegúrate de que esta vista exista
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($user->profile_image) {
            Storage::delete($user->profile_image);
        }

        $path = $request->file('profile_image')->store('profile_images', 'public');

        $user->imagen_perfil = $path;
        $user->save();

        return redirect()->back()->with('success', 'Imagen de perfil actualizada correctamente.');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function users()
    {
        $users = Collaborator::all();
        return view('users.users')->with('collaborators', $users);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Asegúrate de que el email sea único en la tabla de usuarios
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // Redirige de vuelta con errores
        }

        try {
            $name = $request->input('nombre');
            $email = $request->input('email');

            $this->collaboratorService->createCollaborator($name, $email);

            return redirect('/admin/colaboradores')->with('success', 'Colaborador creado correctamente.');
        } catch (\Exception $e) {
            return redirect('/admin/colaboradores')->with('error', 'Error al crear el colaborador: ' . $e->getMessage());
        }
    }


    public function logout()
    {
        Auth::logout(); // Cierra la sesión del usuario
        return redirect('/login'); // Redirige al usuario a la página de inicio de sesión o a la página que desees después del cierre de sesión.
    }
}
