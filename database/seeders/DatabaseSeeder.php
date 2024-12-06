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
        DB::insert('insert into users (name, email, password, user_type, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [
            'admin',
            'admin@adminlte.com',
            bcrypt('password123'),
            'Admin',
            now(),
            now(),
        ]);

        
    }
}
