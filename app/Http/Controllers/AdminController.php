<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function home(){
        return view('admin.home');
    }

    public function indexUsuarios(){
        $usuarios = DB::select("
            SELECT 
                id, 
                name, 
                email, 
                user_type, 
                habilitado, 
                created_at 
            FROM users
        ");
        return view('admin.usuarios')->with('usuarios', $usuarios);
    }
    

    public function desactivarUsuario($id){
        // Desactivar usuario (habilitado = 0)
        DB::update("
            UPDATE users
            SET habilitado = 0
            WHERE id = ?
        ", [$id]);
    
        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario desactivado correctamente.');
    }
    
    public function activarUsuario($id){
        // Activar usuario (habilitado = 1)
        DB::update("
            UPDATE users
            SET habilitado = 1
            WHERE id = ?
        ", [$id]);
    
        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario activado correctamente.');
    }

    
}
