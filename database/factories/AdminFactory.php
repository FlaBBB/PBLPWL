<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $nip = fake()->unique()->numerify('##########'),
            'id_user' => User::factory()->state([
                'username' => $nip,
                'role' => UserRoleEnum::ADMIN,
            ]),
            'name' => fake()->name(),
        ];
    }
}
