<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TemaSeeder::class,
            AdminUserSeeder::class,
            DocenteSeeder::class,
            EstudianteSeeder::class,
            AtencionSeeder::class,
        ]);
    }
}
