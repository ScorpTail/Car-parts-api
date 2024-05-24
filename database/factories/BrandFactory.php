<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use App\Services\CarProviderFaker\CarFaker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new CarFaker($this->faker));

        return [
            'name' => $this->faker->carBrand(),
            'image_path' => 'http://localhost/storage/2024/05/16/fa3218c68db627151ddf621f381a8572d589b501.png',
        ];
    }

}
