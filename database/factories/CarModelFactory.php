<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Services\CarProviderFaker\CarFaker;
use Faker\Provider\FakeCar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarModel>
 */
class CarModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $currentBrandIndex = 0;
    public function definition(): array
    {
        $this->faker->addProvider(new CarFaker($this->faker));

        if ($this->currentBrandIndex >= 50) {
            $this->currentBrandIndex = 0;
        }

        $brand = Brand::orderBy('id')->skip($this->currentBrandIndex)->first();

        $this->currentBrandIndex++;


        $modelName = $this->faker->carModel($brand->name);

        return [
            'name' => $modelName,
            'brand_id' => $brand->id,
            'image_path' => '2024/05/16/fa3218c68db627151ddf621f381a8572d589b501.png',
        ];
    }
}
