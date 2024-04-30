<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        $password = Hash::make('rB3S9nKpLQ7a');

        User::create([
            'username' => 'admin',
            'password' => $password,
            'role_id' => '4',
            'created_by' => 'system'
        ]);

        Profile::create([
            'name' => 'Super Admin',
            'user_id' => '1',
            'gender' => 'l',
            'created_by' => 'system'
        ]);
    }
}
