<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alias' => fake()->regexify('[A-Za-z0-9]{16}'),
            'title' => fake()->sentence(2),
            'destination_url' => fake()->url(),
            'user_id' => User::factory(),
        ];
    }
}
