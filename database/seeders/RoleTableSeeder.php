<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'anggota']);
        Role::create(['name' => 'pengurus']);
        Role::create(['name' => 'ketua']);
        Role::create(['name' => 'admin']);

    }
}
