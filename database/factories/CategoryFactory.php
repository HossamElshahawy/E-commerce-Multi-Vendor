<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'summary'=>$this->faker->sentence(3),
            'photo'=>$this->faker->imageUrl('350','350'),
            'parent_id'=>$this->faker->randomElement(Category::pluck('id')->toArray()),
            'is_parent'=>$this->faker->randomElement([true,false]),
            'status'=>$this->faker->randomElement(['active','inactive'])
        ];
    }
}
