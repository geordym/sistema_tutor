<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        
    }
}
