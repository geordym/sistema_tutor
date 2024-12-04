<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserType;
use App\Models\Estudiante;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'user_type' => \App\Enums\UserType::Admin,
            'name' => 'Admin',
            'email' => 'admin@adminlte.com',
            'password' => bcrypt('password123'), // Reemplaza 'password123' con la contraseña deseada
        ]);

       
        // Crear un estudiante
        $studentUser = User::factory()->create([
            'user_type' => UserType::Estudiante,
            'name' => 'Estudiante Ejemplar',
            'email' => 'estudiante@domain.com',
            'password' => bcrypt('password123'),
        ]);

        Estudiante::create([
            'nombre' => $studentUser->name,
            'matricula' => 'EST12345',
            'correo' => $studentUser->email,
            'telefono' => '987654321',
            'fecha_nacimiento' => '2000-01-01',
            'direccion' => 'Avenida 456, Ciudad',
            'user_id' => $studentUser->id,
        ]);

        DB::table('areas')->insert([
            ['nombre' => 'Medicina', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Administración', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ingeniería en Sistemas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Matemáticas', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('materias')->insert([
            [
                'area_id' => 1,  // Medicina
                'nombre' => 'Anatomía',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,  // Administración
                'nombre' => 'Gestión Empresarial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 3,  // Ingeniería en Sistemas
                'nombre' => 'Programación Avanzada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 4,  // Matemáticas
                'nombre' => 'Cálculo Diferencial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        $tutorUser = User::factory()->create([
            'user_type' => UserType::Tutor,
            'name' => 'Tutor Principal',
            'email' => 'tutor@domain.com',
            'password' => bcrypt('password123'),
        ]);

        Tutor::create([
            'nombre' => $tutorUser->name,
            'area_id' => 1,
            'materia_id' => 1,
            'telefono' => '123456789',
            'costo_por_hora' => 5000,
            'correo' => $tutorUser->email,
            'direccion' => 'Calle 123, Ciudad',
            'user_id' => $tutorUser->id,
        ]);

        
    }
}
