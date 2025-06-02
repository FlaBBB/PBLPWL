<?php

namespace Database\Factories;

use App\Enums\AchievementStatusEnum;
use App\Enums\CompetitionLevelEnum;
use App\Models\Achievement;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    protected $model = Achievement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->randomNumber(),
            'upload_at' => fake()->dateTimeThisYear(),
            'competition_type' => fake()->word(),
            'competition_name' => fake()->sentence(),
            'competition_name_english' => fake()->sentence(),
            'competition_location' => fake()->city(),
            'competition_location_english' => fake()->city(),
            'competition_url' => fake()->url(),
            'start_at' => fake()->date(),
            'end_at' => fake()->date(),
            'pt_partition_number' => fake()->randomNumber(),
            'partition_number' => fake()->randomNumber(),
            'assignment_letter_number' => fake()->word(),
            'assignment_letter_date' => fake()->date(),
            'file_assignment_letter' => fake()->word(),
            'file_certificate' => fake()->word(),
            'file_activity_photo' => fake()->word(),
            'file_poster' => fake()->word(),
            'level' => fake()->randomElement(['PROVINCE', 'NATIONAL', 'INTERNATIONAL']),
            'place' => fake()->numberBetween(1, 3),
            'status' => fake()->randomElement(AchievementStatusEnum::cases()),
            'note' => fake()->paragraph(),
            'verificator' => Admin::pluck("nip")->random(),
            'verified_at' => fake()->date(),
        ];
    }
}
