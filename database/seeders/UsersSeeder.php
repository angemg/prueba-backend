<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => 'qwerty',
            'role' =>'Admin',
        ])->assignRole('Admin');

        User::create([
            'name' => 'Angelica',
            'email' => 'angelica@gmail.com',
            'password' => 'qwerty',
            'role' =>'UserJunior',
        ])->assignRole('UserJunior');
        
        User::create([
            'name' => 'Martinez',
            'email' => 'martinez@gmail.com',
            'password' => 'qwerty',
            'role' =>'UserVip',
        ])->assignRole('UserVip');

    }
}
