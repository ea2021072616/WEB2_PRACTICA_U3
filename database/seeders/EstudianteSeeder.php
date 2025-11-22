<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $estudiantes = [
            ['codigo' => '2020057001', 'apellidos' => 'Mamani Quispe', 'nombres' => 'Juan Carlos', 'email' => 'estudiante1@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2020057002', 'apellidos' => 'Flores Ramos', 'nombres' => 'María Fernanda', 'email' => 'estudiante2@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2021058003', 'apellidos' => 'Gutiérrez Silva', 'nombres' => 'Pedro Antonio', 'email' => 'estudiante3@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2021058004', 'apellidos' => 'Chávez López', 'nombres' => 'Ana Lucía', 'email' => 'estudiante4@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2021058005', 'apellidos' => 'Vargas Mendoza', 'nombres' => 'Luis Alberto', 'email' => 'estudiante5@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2022059006', 'apellidos' => 'Quispe Huanca', 'nombres' => 'Rosa María', 'email' => 'estudiante6@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2022059007', 'apellidos' => 'Torres Paredes', 'nombres' => 'Jorge Eduardo', 'email' => 'estudiante7@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2022059008', 'apellidos' => 'Ramos Castro', 'nombres' => 'Sofía Isabel', 'email' => 'estudiante8@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2023060009', 'apellidos' => 'Pérez Sánchez', 'nombres' => 'Diego Alejandro', 'email' => 'estudiante9@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2023060010', 'apellidos' => 'Rodríguez Vega', 'nombres' => 'Carla Daniela', 'email' => 'estudiante10@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2023060011', 'apellidos' => 'Mendoza Cruz', 'nombres' => 'Miguel Ángel', 'email' => 'estudiante11@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2024061012', 'apellidos' => 'García Flores', 'nombres' => 'Valentina Nicole', 'email' => 'estudiante12@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2024061013', 'apellidos' => 'Salazar Pinto', 'nombres' => 'Roberto Carlos', 'email' => 'estudiante13@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2024061014', 'apellidos' => 'Castillo Morales', 'nombres' => 'Gabriela Andrea', 'email' => 'estudiante14@virtual.upt.pe', 'password' => 'estudiante123'],
            ['codigo' => '2024061015', 'apellidos' => 'Huamán Ccoya', 'nombres' => 'Fernando José', 'email' => 'estudiante15@virtual.upt.pe', 'password' => 'estudiante123'],
        ];

        foreach ($estudiantes as $estudianteData) {
            $user = User::create([
                'name' => $estudianteData['nombres'] . ' ' . $estudianteData['apellidos'],
                'email' => $estudianteData['email'],
                'password' => Hash::make($estudianteData['password']),
                'role' => 'estudiante',
                'email_verified_at' => now(),
            ]);

            Estudiante::create([
                'user_id' => $user->id,
                'codigo' => $estudianteData['codigo'],
                'apellidos' => $estudianteData['apellidos'],
                'nombres' => $estudianteData['nombres'],
            ]);
        }
    }
}
