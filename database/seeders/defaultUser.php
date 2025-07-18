<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class defaultUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        DB::table('users')->insert([
            'username' => 'admin01',
            'email' => 'admin01@example.org',
            'password' => Hash::make('admin01'),
            'role_id' => 1,
            'created_at' => now(),
        ]);
        // staf
        DB::table('users')->insert([
            'username' => 'staf01',
            'email' => 'staf01@example.org',
            'password' => Hash::make('staf01'),
            'role_id' => 2,
            'created_at' => now(),
        ]);
        // notaris
        DB::table('users')->insert([
            'username' => 'notaris01',
            'email' => 'notaris01@example.org',
            'password' => Hash::make('notaris01'),
            'role_id' => 3,
            'created_at' => now(),
        ]);
        // klien
        DB::table('users')->insert([
            'username' => 'klien01',
            'email' => 'klien01@example.org',
            'password' => Hash::make('klien01'),
            'role_id' => 4,
            'created_at' => now(),
        ]);
        DB::table('users')->insert([
            'username' => 'klien02',
            'email' => 'klien02@example.org',
            'password' => Hash::make('klien02'),
            'role_id' => 4,
            'created_at' => now(),
        ]);
    }
}
