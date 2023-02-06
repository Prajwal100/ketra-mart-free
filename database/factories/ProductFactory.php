<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'summary' => $this->faker->paragraphs(3, true),
            'description' => $this->faker->paragraphs(3, true),
            'features' => $this->faker->paragraphs(3, true),

            'stock' => $this->faker->numberBetween(2, 10),
            'cat_id' => $this->faker->randomElement(Category::where('is_parent', 1)->pluck('id')->toArray()),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent', 0)->pluck('id')->toArray()),

            'featured_image' => 'backend/assets/images/default-img.jpg',

            'is_featured' => 0,

            'colors' => json_encode([]),
            'attributes' => json_encode([]),
            'choice_options' => json_encode([]),

            'silhouette' => json_encode([]),
            'neckline' => json_encode([]),

            'discount_type' => 'percent',

            'price' => $this->faker->numberBetween(100, 1000),
            'purchase_price' => $this->faker->numberBetween(100, 1000),

            'discount' => $this->faker->numberBetween(0, 90),
            'status' => 'active',
        ];
    }
}
