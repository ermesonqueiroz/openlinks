<?php

namespace Database\Factories;

use App\Enums\VisitPlatform;
use App\Models\Link;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visit>
 */
class VisitFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'referer_host' => fake()->word(),
            'referer_url' => fake()->url(),
            'user_agent' => fake()->word(),
            'platform' => fake()->randomKey(VisitPlatform::toArray()),
            'link_id' => Link::factory(),
        ];
    }

    public function withPlatform(VisitPlatform $platform): static
    {
        return $this->state(fn (array $attributes) => [
            'platform' => $platform->value
        ]);
    }
}
