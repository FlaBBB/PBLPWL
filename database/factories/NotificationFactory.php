<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::inRandomOrder()->first()->id,
            'id_reference' => fake()->optional()->randomNumber(), // Example: can be null
            'type' => fake()->randomElement(['message', 'task', 'announcement', 'warning']),
            'content' => fake()->paragraph(),
            'is_read' => fake()->boolean(),
            'sender_id' => fake()->optional()->randomElement(User::pluck('id')),
            'read_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
