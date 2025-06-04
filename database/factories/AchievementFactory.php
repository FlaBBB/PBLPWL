<?php

namespace Database\Factories;

use App\Enums\AchievementStatusEnum;
use App\Enums\CompetitionLevelEnum;
use App\Models\Achievement;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    protected $model = Achievement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'upload_at' => fake()->dateTimeThisYear(),
            'competition_name' => fake()->sentence(),
            'competition_name_english' => fake()->sentence(),
            'competition_location' => fake()->city(),
            'competition_location_english' => fake()->city(),
            'competition_url' => fake()->url(),
            'start_at' => fake()->date(),
            'end_at' => fake()->date(),
            'pt_partition_number' => fake()->randomNumber(),
            'partition_number' => fake()->randomNumber(),
            'assignment_letter_number' => fake()->word(),
            'assignment_letter_date' => fake()->date(),
            'file_assignment_letter' => $this->storeAsset('surat-tugas.pdf', 'assignment_letters'),
            'file_certificate' => $this->storeAsset('sertifikat.pdf', 'certificates'),
            'file_activity_photo' => $this->storeRandomDocumentationPhoto('activity_photos'),
            'file_poster' => $this->storeAsset('poster.jpeg', 'posters'),
            'level' => fake()->randomElement(['PROVINCE', 'NATIONAL', 'INTERNATIONAL']),
            'place' => fake()->numberBetween(1, 3),
            'status' => fake()->randomElement(AchievementStatusEnum::cases()),
            'note' => fake()->paragraph(),
            'verificator' => Admin::pluck("nip")->random(),
            'verified_at' => fake()->date(),
        ];
    }

    /**
     * Store a given asset file to public storage.
     *
     * @param string $filename
     * @param string $directory
     * @return string
     */
    protected function storeAsset(string $filename, string $directory): string
    {
        $sourcePath = database_path('factories/assets/' . $filename);
        $destinationPath = 'public/' . $directory . '/' . $filename;
        Storage::put($destinationPath, File::get($sourcePath));
        return 'storage/' . $directory . '/' . $filename;
    }

    /**
     * Store a random documentation photo to public storage.
     *
     * @param string $directory
     * @return string
     */
    protected function storeRandomDocumentationPhoto(string $directory): string
    {
        $photos = [];
        for ($i = 0; $i <= 8; $i++) {
            $photos[] = 'dokumentasi-' . $i . '.jpg';
        }
        $randomPhoto = fake()->randomElement($photos);
        $sourcePath = database_path('factories/assets/' . $randomPhoto);
        $destinationPath = 'public/' . $directory . '/' . $randomPhoto;
        Storage::put($destinationPath, File::get($sourcePath));
        return 'storage/' . $directory . '/' . $randomPhoto;
    }
}
