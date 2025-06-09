<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Dosen;
use App\Models\SupervisorAchievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupervisorAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = Achievement::all();
        $dosen = Dosen::all();

        foreach ($achievements as $achievement) {
            // Ensure there are enough unique dosen to assign
            if ($dosen->isEmpty()) {
                break;
            }

            // Get a random dosen that hasn't been assigned to this achievement yet
            $assignedDosenNidns = $achievement->dosen->pluck('nidn')->toArray();
            $availableDosen = $dosen->whereNotIn('nidn', $assignedDosenNidns);

            if ($availableDosen->isNotEmpty()) {
                $randomDosen = $availableDosen->random();
                SupervisorAchievement::create([
                    'id_achievement' => $achievement->id,
                    'nidn' => $randomDosen->nidn,
                    'role' => \App\Models\RoleSupervisor::pluck('id')->random(), // Assign a random role
                ]);
            }
        }
    }
}
