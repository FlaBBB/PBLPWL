<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Enums\UserRoleEnum;
use App\Models\MahasiswaPreferences;
use App\Models\Mark;
use App\Models\User;
use App\Models\Tag;
use Database\Factories\MahasiswaPreferencesFactory;
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
            'nim' => $nim = fake()->unique()->numerify('############'),
            'id_user' => User::factory()->state([
                'username' => $nim,
                'role' => UserRoleEnum::MAHASISWA,
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
                'nim' => (string) $mahasiswa->nim, // Explicitly cast to string
            ]);
            $tagIds = Tag::pluck('id')->shuffle()->take(fake()->numberBetween(1, 4));

            $nim = str_pad($mahasiswa->nim, 12, '0', STR_PAD_LEFT); // getting around of bug

            $tagIds->each(function ($tagId) use ($nim) {
                MahasiswaPreferencesFactory::new()->create([
                    'nim' => (string) $nim, // Explicitly cast to string
                    'id_tag' => $tagId,
                ]);
            });
        });
    }
}
