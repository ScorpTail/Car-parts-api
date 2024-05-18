<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

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
        $brands = $this->listOfCarBrands();
        return [
            'name' => $this->faker->randomElement($brands),
            'image_path' => 'http://localhost/storage/2024/05/16/fa3218c68db627151ddf621f381a8572d589b501.png',
        ];
    }


    private function listOfCarBrands()
    {
        return [
            'Acura',
            'Alfa Romeo',
            'Audi',
            'Bentley',
            'Bmw',
            'Cadillac',
            'Chery',
            'Chevrolet',
            'Chrysler',
            'Citroën',
            'Dacia',
            'Daewoo',
            'Daihatsu',
            'Dodge',
            'Fiat',
            'Ford',
            'Ford Usa',
            'Geely',
            'Great Wall',
            'Haval',
            'Honda',
            'Hummer',
            'Hyundai',
            'Infiniti',
            'Isuzu',
            'Jaguar',
            'Jeep',
            'Kia',
            'Lada',
            'Lancia',
            'Land Rover',
            'Lexus',
            'Mazda',
            'Mercedes-Benz',
            'Mini',
            'Mitsubishi',
            'Nissan',
            'Opel',
            'Peugeot',
            'Porsche',
            'Renault',
            'Renault Trucks',
            'Rover',
            'Saab',
            'Seat',
            'Skoda',
            'Smart',
            'Ssangyong',
            'Subaru',
            'Suzuki',
            'Tesla',
            'Toyota',
            'Volvo',
            'Vw',
            'Zaz',
        ];
    }
}
