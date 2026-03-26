<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Seed the roles table.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'nom' => 'Admin',
            ],
            [
                'id' => 2,
                'nom' => 'Artisan',
            ],
            [
                'id' => 3,
                'nom' => 'Client',
            ],
        ]);
    }
}
