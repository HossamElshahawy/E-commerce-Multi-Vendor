<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [

            'title'=>$this->faker->word,
            'slug'=>$this->faker->unique()->slug,
            'summary'=>$this->faker->sentence(3),
            'description'=>$this->faker->paragraph,
            'stock'=>$this->faker->numberBetween([2,10]),
            'brand_id'=>$this->faker->randomElement(Brand::pluck('id')->toArray()),
            'category_id'=>$this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_category_id'=>$this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo'=>$this->faker->imageUrl('100','100'),
            'price'=>$this->faker->numberBetween(100,1000),
            'offer_price'=>$this->faker->numberBetween(100,1000),
            'discount'=>$this->faker->numberBetween(100,1000),
            'size'=>$this->faker->randomElement(['S','M','L']),
            'condition'=>$this->faker->randomElement(['new','popular','winter']),
            'vendor_id'=>$this->faker->randomElement(User::pluck('id')->toArray()),
            'status'=>$this->faker->randomElement(['active','inactive']),





        ];
    }
}
