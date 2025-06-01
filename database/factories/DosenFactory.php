<?php

namespace Database\Factories;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    protected $model = Dosen::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nidn' => $nidn = fake()->unique()->numerify('############'),
            'id_user' => User::factory()->state([
                'username' => $nidn,
                'role' => \App\Enums\UserRoleEnum::DOSEN,
            ]),
            'name' => fake()->name(),
        ];
    }
}
