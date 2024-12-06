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
            DB::insert("
            INSERT INTO users (user_type, name, email, password, created_at, updated_at) 
            VALUES (:user_type, :name, :email, :password, NOW(), NOW())
        ", [
                'user_type' => 'estudiante',
                'name' => $request->input('nombre'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            $userId = DB::selectOne("SELECT LAST_INSERT_ID() AS id")->id;

            DB::insert("
            INSERT INTO estudiantes (nombre, correo, fecha_nacimiento, user_id, matricula, telefono, direccion, created_at, updated_at) 
            VALUES (:nombre, :correo, :fecha_nacimiento, :user_id, :matricula, :telefono, :direccion, NOW(), NOW())
        ", [
                'nombre' => $request->input('nombre'),
                'correo' => $request->input('email'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'user_id' => $userId,
                'matricula' => $request->input('matricula'),
                'telefono' => $request->input('telefono'),
                'direccion' => $request->input('direccion'),
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
        $areas = DB::select("
            SELECT a.id AS area_id, a.nombre AS area_nombre
            FROM areas AS a
            ORDER BY a.nombre
        ");

        foreach ($areas as $area) {
            $area->area_nombre = $this->removeAccents($area->area_nombre);

            $area->materias = DB::select("
                SELECT m.id AS materia_id, m.nombre AS materia_nombre
                FROM materias AS m
                WHERE m.area_id = :area_id
                ORDER BY m.nombre
            ", ['area_id' => $area->area_id]);
        }


        return view('public.registrar_tutor')->with('areasMaterias', $areas);
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
        //dd($request);
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'materia' => 'required|string|max:255',
            'costo_por_hora' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();

        try {
            // 1. Insertar el nuevo usuario en la tabla de usuarios
           DB::insert("
            INSERT INTO users (user_type, name, email, password, created_at, updated_at)
            VALUES (:user_type, :name, :email, :password, :created_at, :updated_at);
        ", [
                'user_type' => 'tutor',
                'name' => $request->input('nombre'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')), // Hasheo de la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $userId = DB::getPdo()->lastInsertId(); // Obtener el ID del usuario insertado

            // 2. Insertar los datos del tutor
            DB::select("
            INSERT INTO tutores (user_id, materia_id, area_id, nombre, telefono, correo, direccion, costo_por_hora, created_at, updated_at)
            VALUES (:user_id, :materia_id, :area_id, :nombre, :telefono, :correo, :direccion, :costo_por_hora, :created_at, :updated_at);
        ", [
                'user_id' => $userId,
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
