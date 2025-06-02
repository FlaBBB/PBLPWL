<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\MahasiswaPreferences;
use App\Models\Mark;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => $nim = fake()->unique()->numerify('2###########'),
            'id_user' => User::factory()->state([
                'username' => $nim,
                'role' => \App\Enums\UserRoleEnum::MAHASISWA,
            ]),
            'name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'city' => fake()->city(),
            'district' => fake()->citySuffix(),
            'subdistrict' => fake()->streetName(),
            'address' => fake()->address(),
            'prodi' => fake()->randomElement(['TI', 'SIB']),
            'grade' => fake()->numberBetween(1, 8),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Mahasiswa $mahasiswa) {
            Mark::factory()->create([
                'nim' => $mahasiswa->nim,
            ]);
            MahasiswaPreferencesFactory::new()->count(fake()->numberBetween(1, 4))->create([
                'nim' => $mahasiswa->nim,
            ]);
        });
    }
}
