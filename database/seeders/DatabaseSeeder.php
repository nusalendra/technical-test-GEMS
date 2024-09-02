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
        Role::create([
            'nama' => 'Manager',
        ]);

        User::create([
            'name' => 'Budi Erwandi',
            'username' => 'budierwandi',
            'password' => bcrypt('budierwandi'),
            'role_id' => 1
        ]);

        Manager::create([
            'url_tanda_tangan' => null,
            'user_id' => 1
        ]);
    }
}
