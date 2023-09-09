<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->word,
            'slug'=>$this->faker->unique()->slug,
            'photo'=>$this->faker->imageUrl('350','350'),
            'summary'=>$this->faker->sentence(1),
            'condition'=>$this->faker->randomElement(['banner','promo']),
            'status'=>$this->faker->randomElement(['active','inactive'])
        ];
    }
}
