<?php

namespace Database\Factories;

use App\Models\Part;
use App\Models\CarModel;
use App\Services\CarProviderFaker\CarFaker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CarPartFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Part::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new CarFaker($this->faker));
        return [
            'model_id' => CarModel::all()->random()->id,
            'article' => fake()->numberBetween(0, 1000000),
            'country_production' => $this->faker->country(),
            'name' => $this->faker->carPart(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 100, 10000),
            'status' => fake()->numberBetween(1, 3),
            'image_path' => 'http://localhost/storage/2024/05/16/fa3218c68db627151ddf621f381a8572d589b501.png',

        ];
    }
}
