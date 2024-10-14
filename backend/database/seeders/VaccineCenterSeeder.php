<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centers = [
            ['name' => 'Center 1', 'daily_limit' => 2],
            ['name' => 'Center 2', 'daily_limit' => 5],
            ['name' => 'Center 3', 'daily_limit' => 10],
            ['name' => 'Center 4', 'daily_limit' => 15],
            ['name' => 'Center 5', 'daily_limit' => 20],
            ['name' => 'Center 6', 'daily_limit' => 25],
            ['name' => 'Center 7', 'daily_limit' => 8],
            ['name' => 'Center 8', 'daily_limit' => 12],
            ['name' => 'Center 9', 'daily_limit' => 20],
            ['name' => 'Center 10', 'daily_limit' => 8],
            ['name' => 'Center 11', 'daily_limit' => 12],
            ['name' => 'Center 12', 'daily_limit' => 20],
            ['name' => 'Center 13', 'daily_limit' => 8],
            ['name' => 'Center 14', 'daily_limit' => 12],
            ['name' => 'Center 15', 'daily_limit' => 12],
        ];
    
        foreach ($centers as $center) {
            VaccineCenter::create($center);
        }
    }
}
