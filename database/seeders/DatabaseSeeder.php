<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Role::create([
            'nama' => 'Manager',
        ]);

        User::create([
            'name' => 'manager',
            'username' => 'manager',
            'password' => bcrypt('manager'),
            'role_id' => 1
        ]);

        Role::create([
            'nama' => 'Karyawan',
        ]);

        User::create([
            'name' => 'karyawan',
            'username' => 'karyawan',
            'password' => bcrypt('karyawan'),
            'role_id' => 2
        ]);
    }
}
