<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            'name' => 'Troubleshooting',
            'area' => 'North',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('departments')->insert([
            'name' => 'Troubleshooting',
            'area' => 'South',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('departments')->insert([
            'name' => 'Relay Setting',
            'area' => null, // No specific area for Relay Setting
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('departments')->insert([
            'name' => 'Contracts',
            'area' => null, // No specific area for Relay Setting
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('departments')->insert([
            'name' => 'Data Scan',
            'area' => null, // No specific area for Relay Setting
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('departments')->insert([
            'name' => 'Technical Monitoring',
            'area' => null, // No specific area for Relay Setting
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
