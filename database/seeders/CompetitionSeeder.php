<?php

namespace Database\Seeders;

use App\Models\Competition;
use Database\Factories\CompetitionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompetitionFactory::new()->count(10)->create();
    }
}
