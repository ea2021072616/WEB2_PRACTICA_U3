<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Docente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DocenteSeeder extends Seeder
{
    public function run(): void
    {
        $docentes = [
            [
                'name' => 'Dra. María González',
                'email' => 'docente1@upt.pe',
                'password' => 'docente123',
                'apellidos' => 'González Mendoza',
                'nombres' => 'María Elena',
            ],
            [
                'name' => 'Dr. José Ramírez',
                'email' => 'docente2@upt.pe',
                'password' => 'docente123',
                'apellidos' => 'Ramírez Castillo',
                'nombres' => 'José Antonio',
            ],
            [
                'name' => 'Mg. Ana Torres',
                'email' => 'docente3@upt.pe',
                'password' => 'docente123',
                'apellidos' => 'Torres Vargas',
                'nombres' => 'Ana Sofía',
            ],
            [
                'name' => 'Dr. Luis Fernández',
                'email' => 'docente4@upt.pe',
                'password' => 'docente123',
                'apellidos' => 'Fernández Rojas',
                'nombres' => 'Luis Miguel',
            ],
            [
                'name' => 'Mg. Carmen Salazar',
                'email' => 'docente5@upt.pe',
                'password' => 'docente123',
                'apellidos' => 'Salazar Pérez',
                'nombres' => 'Carmen Rosa',
            ],
        ];

        foreach ($docentes as $docenteData) {
            $user = User::create([
                'name' => $docenteData['name'],
                'email' => $docenteData['email'],
                'password' => Hash::make($docenteData['password']),
                'role' => 'docente',
                'email_verified_at' => now(),
            ]);

            Docente::create([
                'user_id' => $user->id,
                'apellidos' => $docenteData['apellidos'],
                'nombres' => $docenteData['nombres'],
            ]);
        }
    }
}
