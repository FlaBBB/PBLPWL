<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Database\Factories\AchievementFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AchievementFactory::new()->count(10)->create();
    }
}
