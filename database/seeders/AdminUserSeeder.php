<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Docente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Dr. Carlos Administrador',
            'email' => 'admin@upt.pe',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        Docente::create([
            'user_id' => $user->id,
            'apellidos' => 'Administrador Torres',
            'nombres' => 'Carlos Alberto',
        ]);
    }
}
