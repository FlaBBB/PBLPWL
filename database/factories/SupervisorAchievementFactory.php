<?php

namespace Database\Factories;

use App\Models\Achievement;
use App\Models\Dosen;
use App\Models\RoleSupervisor;
use App\Models\SupervisorAchievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupervisorAchievement>
 */
class SupervisorAchievementFactory extends Factory
{
    protected $model = SupervisorAchievement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_achievement' => Achievement::pluck('id')->random(),
            'nidn' => Dosen::pluck('nidn')->random(),
            'role' => RoleSupervisor::pluck('id')->random(),
        ];
    }
}
