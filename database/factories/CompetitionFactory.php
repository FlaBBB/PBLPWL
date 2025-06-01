<?php

namespace Database\Factories;

use App\Enums\CompetitionLevelEnum;
use App\Enums\CompetitionStatusEnum;
use App\Models\Admin;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competition>
 */
class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->randomNumber(),
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'level' => fake()->randomElement(CompetitionLevelEnum::cases()),
            'poster' => fake()->word(),
            'organizer' => fake()->company(),
            'start_at' => fake()->date(),
            'end_at' => fake()->date(),
            'registration_deadline' => fake()->date(),
            'registration_link' => fake()->url(),
            'registration_fee' => fake()->numberBetween(0, 100000),
            'max_participation_amount' => fake()->numberBetween(1, 10),
            'creator' => User::factory(),
            'status' => fake()->randomElement(CompetitionStatusEnum::cases()),
            'rejection_note' => fake()->paragraph(),
            'verificator' => Admin::inRandomOrder()->first()->nip,
            'verified_at' => fake()->date(),
        ];
    }
}
