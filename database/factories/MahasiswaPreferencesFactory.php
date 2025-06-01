<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\MahasiswaPreferences;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MahasiswaPreferences>
 */
class MahasiswaPreferencesFactory extends Factory
{
    protected $model = MahasiswaPreferences::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => Mahasiswa::factory(),
            'id_tag' => Tag::factory(),
        ];
    }
}
