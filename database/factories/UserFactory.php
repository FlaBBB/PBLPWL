<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(UserRoleEnum::cases()),
            'photo_profile' => $this->storeRandomPhotoProfile('photo_profiles'),
            'email' => fake()->unique()->safeEmail(),
        ];
    }

    /**
     * Store a random photo profile to public storage.
     *
     * @param string $directory
     * @return string
     */
    protected function storeRandomPhotoProfile(string $directory): string
    {
        $photos = File::files(database_path('factories/assets/photo-profile'));
        $randomPhoto = fake()->randomElement($photos);
        $filename = $randomPhoto->getFilename();
        $sourcePath = $randomPhoto->getPathname();
        $destinationPath = 'public/' . $directory . '/' . $filename;
        Storage::put($destinationPath, File::get($sourcePath));
        return 'storage/' . $directory . '/' . $filename;
    }

}
