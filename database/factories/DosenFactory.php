<?php

namespace Database\Factories;

use App\Models\Dosen;
use App\Models\User;
use App\Enums\UserRoleEnum;
use App\Models\Tag;
use Database\Factories\DosenPreferenceFactory;
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
                'role' => UserRoleEnum::DOSEN,
            ]),
            'name' => fake()->name(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Dosen $dosen) {
            $tagIds = Tag::pluck('id')->shuffle()->take(fake()->numberBetween(1, 4));

            $tagIds->each(function ($tagId) use ($dosen) {
                DosenPreferenceFactory::new()->create([
                    'nidn' => $dosen->nidn,
                    'id_tag' => $tagId,
                ]);
            });
        });
    }
}
