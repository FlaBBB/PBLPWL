<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Models\CompetitionTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetitionTag>
 */
class CompetitionTagFactory extends Factory
{
    protected $model = CompetitionTag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_competition' => Competition::pluck('id')->random(),
            'id_tag' => Tag::pluck('id')->random(),
        ];
    }
}
