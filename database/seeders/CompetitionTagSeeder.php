<?php

namespace Database\Seeders;

use App\Models\CompetitionTag;
use Database\Factories\CompetitionTagFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompetitionTagFactory::new()->count(10)->create();
    }
}
