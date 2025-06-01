<?php

namespace Database\Factories;

use App\Models\RoleSupervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoleSupervisor>
 */
class RoleSupervisorFactory extends Factory
{
    protected $model = RoleSupervisor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->randomNumber(),
            'description' => fake()->sentence(),
        ];
    }
}
