<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'product_id'=>$this->faker->randomElement(Product::pluck('id')->toArray()),
            'rate'=>$this->faker->numberBetween(1,5),
            'review'=>$this->faker->paragraphs(3,true),
            'status'=>$this->faker->randomElement(['active','inactive']),
        ];
    }
}
