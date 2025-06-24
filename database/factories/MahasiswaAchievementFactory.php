<?php

namespace Database\Factories;

use App\Enums\MahasiswaAchievementRoleEnum;
use App\Models\Achievement;
use App\Models\MahasiswaAchievement;
use App\Models\Mahasiswa;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MahasiswaAchievement>
 */
class MahasiswaAchievementFactory extends Factory
{
    protected $model = MahasiswaAchievement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_achievement' => Achievement::pluck('id')->random(),
            'nim' => Mahasiswa::pluck('nim')->random(),
            'role' => fake()->randomElement(MahasiswaAchievementRoleEnum::cases()),
            'id_tag' => Tag::pluck('id')->random(),
        ];
    }
}
