<?php

namespace Database\Seeders;

use App\Models\MahasiswaAchievement;
use Database\Factories\MahasiswaAchievementFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MahasiswaAchievementFactory::new()->count(10)->create();
    }
}
