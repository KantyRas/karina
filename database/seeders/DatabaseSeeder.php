<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            FonctionSeeder::class,
            FrequenceSeeder::class,
            UserSeeder::class,
            TypeDemandeSeeder::class,
            TypeTravauxSeeder::class,
            DepartementSeeder::class,
            SectionSeeder::class,
        ]);

    }
}
