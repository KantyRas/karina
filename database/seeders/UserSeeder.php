<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'idemploye' => null,
            'username'  => 'kanty',
            'email'     => 'kanty@gmail.com',
            'password'  => Hash::make('kanty'),
            'role'      => 1,
        ]);
        User::create([
            'idemploye' => null,
            'username'  => 'user',
            'email'     => 'user@gmail.com',
            'password'  => Hash::make('12345'),
            'role'      => 2,
        ]);
    }
}
