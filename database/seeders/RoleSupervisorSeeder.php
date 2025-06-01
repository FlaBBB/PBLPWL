<?php

namespace Database\Seeders;

use App\Models\RoleSupervisor;
use Database\Factories\RoleSupervisorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleSupervisorFactory::new()->count(5)->create();
    }
}
