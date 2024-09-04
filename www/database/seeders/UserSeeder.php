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
        if(!User::where('email', 'jmarciosilva@gmail.com')->first()) {
            User::create([
                'name' => 'José Márcio',
                'email' => 'jmarciosilva@gmail.com',
                'password' => Hash::make('123', ['rounds' => 12]),
            ]);
        }

        if(!User::where('email', 'aparecida@gmail.com')->first()) {
            User::create([
                'name' => 'Aparecida Cardoso',
                'email' => 'aparecida@gmail.com',
                'password' => Hash::make('123', ['rounds' => 12]),
            ]);
        }

        if(!User::where('email', 'livia@gmail.com')->first()) {
            User::create([
                'name' => 'Livia Ferreira',
                'email' => 'livia@gmail.com',
                'password' => Hash::make('123', ['rounds' => 12]),
            ]);
        }
    }
}
