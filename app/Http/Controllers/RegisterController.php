<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function registrarEstudianteVista()
    {
        return view('public.registrar_estudiante');
    }

    public function registrarEstudianteGuardar(Request $request)
    {

       //dd($request);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'matricula' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        DB::beginTransaction();


        
        try {
            $userId = DB::table('users')->insertGetId([
                'user_type' => \App\Enums\UserType::Estudiante,
                'name' => $request->input('nombre'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            DB::table('estudiantes')->insert([
                'nombre' => $request->input('nombre'),
                'correo' => $request->input('email'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'user_id' => $userId, 
                'matricula' => $request->input('matricula'),
                'telefono' => $request->input('telefono'),
                'direccion' => $request->input('direccion'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('home')->with('success', 'Estudiante registrado exitosamente');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            // Log del error y redirigir con mensaje de error
            Log::error('Error al registrar estudiante: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error al registrar el estudiante.');
        }
    }

    public function registrarTutorVista()
    {
        // Obtener las áreas y sus materias
        $areasMaterias = DB::table('areas as a')
            ->join('materias as m', 'a.id', '=', 'm.area_id')
            ->select('a.id as area_id', 'a.nombre as area_nombre', 'm.id as materia_id', 'm.nombre as materia_nombre')
            ->orderBy('a.nombre')
            ->orderBy('m.nombre')
            ->get();

        $areasMaterias = $areasMaterias->map(function ($item) {
            $item->area_nombre = $this->removeAccents($item->area_nombre);
            $item->materia_nombre = $this->removeAccents($item->materia_nombre);
            return $item;
        });

        return view('public.registrar_tutor')->with('areasMaterias', $areasMaterias);
    }

    private function removeAccents($string)
    {
        return preg_replace(
            ['/á/', '/é/', '/í/', '/ó/', '/ú/', '/Á/', '/É/', '/Í/', '/Ó/', '/Ú/', '/à/', '/è/', '/ì/', '/ò/', '/ù/', '/À/', '/È/', '/Ì/', '/Ò/', '/Ù/', '/â/', '/ê/', '/î/', '/ô/', '/û/', '/Â/', '/Ê/', '/Î/', '/Ô/', '/Û/', '/ä/', '/ë/', '/ï/', '/ö/', '/ü/', '/Ä/', '/Ë/', '/Ï/', '/Ö/', '/Ü/'],
            ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'],
            $string
        );
    }

    public function registrarTutorGuardar(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'materia' => 'required|string|max:255',
            'costo_por_hora' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
    
        try {
            // 1. Insertar el nuevo usuario en la tabla de usuarios
            $user = DB::table('users')->insertGetId([
                'user_type' => \App\Enums\UserType::Tutor,
                'name' => $request->input('nombre'),
                'email' => $request->input('email'), // Asumiendo que se pide un email
                'password' => bcrypt($request->input('password')), // Asumiendo que se pide una contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ]);



            DB::table('tutores')->insert([
                'user_id' => $user,  // Relacionamos el tutor con el usuario creado
                'materia_id' => $request->input('materia'),
                'area_id' => $request->input('area'),
                'nombre' => $request->input('nombre'),
                'telefono' => $request->input('telefono'),
                'correo' => $request->input('email'),
                'direccion' => $request->input('direccion'),
                'costo_por_hora' => $request->input('costo_por_hora'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Commit de la transacción si todo salió bien
            DB::commit();

            return redirect()->route('tutor.home')->with('success', 'Tutor registrado exitosamente');
        } catch (\Exception $e) {
            dd($e);
            // Rollback en caso de error
            DB::rollBack();

            // Log el error y redirigir con un mensaje de error
            Log::error('Error al registrar tutor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error al registrar el tutor.');
        }
    }
}
