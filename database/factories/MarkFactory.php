<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mark>
 */
class MarkFactory extends Factory
{
    protected $model = Mark::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => Mahasiswa::factory(),
            'ipk' => fake()->randomFloat(2, 0, 4),
            'updated_at' => fake()->dateTimeThisYear(),
            'updated_by' => Admin::inRandomOrder()->first()->nip,
        ];
    }
}
