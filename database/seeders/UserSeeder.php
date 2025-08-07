<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ruben Hernandez Benitez',
            'email' => 'ru27benny87@gmail.com',
            'password' => bcrypt('Spktro1987*')
        ])->assignRole('Admin');
        User::factory(99)->create();
    }
}
