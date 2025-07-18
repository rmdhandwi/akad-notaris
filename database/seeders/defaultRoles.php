<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class defaultRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role_name' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'role_name' => 'staf',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'role_name' => 'notaris',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'role_name' => 'klien',
            'created_at' => now(),
        ]);
    }
}
