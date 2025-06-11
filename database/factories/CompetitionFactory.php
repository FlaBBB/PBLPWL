<?php

namespace Database\Factories;

use App\Enums\CompetitionLevelEnum;
use App\Enums\CompetitionStatusEnum;
use App\Models\Admin;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;

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
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'level' => fake()->randomElement(CompetitionLevelEnum::cases()),
            'poster' => $this->storeRandomCompetitionPoster('competition_posters'),
            'organizer' => fake()->company(),
            'start_at' => fake()->date(),
            'end_at' => fake()->date(),
            'registration_deadline' => fake()->date(),
            'registration_link' => fake()->url(),
            'registration_fee' => fake()->numberBetween(0, 12) * 25_000,
            'max_participation_amount' => fake()->numberBetween(1, 10),
            'creator' => User::pluck('id')->random(),
            'status' => $status = fake()->randomElement(CompetitionStatusEnum::cases()),
            'rejection_note' => $status == CompetitionStatusEnum::REJECTED ? fake()->paragraph() : '',
            'verificator' => Admin::pluck('nip')->random(),
            'verified_at' => fake()->date(),
        ];
    }

    /**
     * Store a random competition poster to public storage.
     *
     * @param string $directory
     * @return string
     */
    protected function storeRandomCompetitionPoster(string $directory): string
    {
        $client = new Client();
        $response = $client->get('https://random-image-pepebigotes.vercel.app/api/random-image');
        $imageContent = $response->getBody()->getContents();

        $filename = 'poster_' . uniqid() . '.jpg';
        $destinationPath = 'public/' . $directory . '/' . $filename;

        Storage::put($destinationPath, $imageContent);

        return 'storage/' . $directory . '/' . $filename;
    }
}
