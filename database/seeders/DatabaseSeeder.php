<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Manager;
use App\Models\Posisi;
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
            'name' => 'Budi Erwandi',
            'username' => 'manager',
            'password' => bcrypt('manager'),
            'role_id' => 1
        ]);

        Manager::create([
            'url_tanda_tangan' => null,
            'user_id' => 1
        ]);

        Role::create([
            'nama' => 'Karyawan',
        ]);

        Posisi::create([
            'nama' => 'General Affair',
        ]);

        User::create([
            'name' => 'Daniel Andrian',
            'username' => 'karyawan',
            'password' => bcrypt('karyawan'),
            'role_id' => 2
        ]);

        Karyawan::create([
            'url_tanda_tangan' => null,
            'user_id' => 2,
            'posisi_id' => 1
        ]);
    }
}
