<?php

namespace Database\Seeders;

use App\Enums\MahasiswaAchievementRoleEnum;
use App\Models\Achievement;
use App\Models\Mahasiswa;
use App\Models\MahasiswaAchievement;
use App\Models\Tag;
use Database\Factories\MahasiswaFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::factory()->count(50)->create()->each(function (Mahasiswa $mahasiswa) {
            $numberOfAchievements = fake()->numberBetween(0, 10);

            for ($i = 0; $i < $numberOfAchievements; $i++) {
                $achievement = Achievement::factory()->create();

                $role = fake()->randomElement([MahasiswaAchievementRoleEnum::PERSONAL, MahasiswaAchievementRoleEnum::LEADER]);
                $teamSize = 1;

                if ($role === MahasiswaAchievementRoleEnum::LEADER) {
                    $teamSize = fake()->numberBetween(2, 5); // Random team size between 2 and 5
                }

                $tags = Tag::pluck('id')->random(fake()->numberBetween(1, 3));

                if ($role === MahasiswaAchievementRoleEnum::PERSONAL) {
                    MahasiswaAchievement::create([
                        'id_achievement' => $achievement->id,
                        'nim' => $mahasiswa->nim,
                        'role' => MahasiswaAchievementRoleEnum::PERSONAL,
                        'id_tag' => $tags->first(),
                    ]);
                } else {
                    // For team achievements, ensure the current mahasiswa is part of the team
                    MahasiswaAchievement::create([
                        'id_achievement' => $achievement->id,
                        'nim' => $mahasiswa->nim,
                        'role' => $role,
                        'id_tag' => $tags->first(),
                    ]);

                    // Add other team members
                    $otherMahasiswa = Mahasiswa::where('nim', '!=', $mahasiswa->nim)->inRandomOrder()->limit($teamSize - 1)->get();
                    foreach ($otherMahasiswa as $member) {
                        MahasiswaAchievement::create([
                            'id_achievement' => $achievement->id,
                            'nim' => $member->nim,
                            'role' => MahasiswaAchievementRoleEnum::MEMBER, // Other members are always 'MEMBER'
                            'id_tag' => $tags->first(),
                        ]);
                    }
                }
            }
        });
    }
}
