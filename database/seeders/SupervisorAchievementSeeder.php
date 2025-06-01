<?php

namespace Database\Seeders;

use App\Models\SupervisorAchievement;
use Database\Factories\SupervisorAchievementFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupervisorAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SupervisorAchievementFactory::new()->count(10)->create();
    }
}
