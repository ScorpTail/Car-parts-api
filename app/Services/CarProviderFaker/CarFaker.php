<?php

namespace App\Services\CarProviderFaker;

use Faker\Generator;

class CarFaker extends \Faker\Provider\Base
{
    public function __construct(Generator $generator)
    {
        parent::__construct($generator);
    }

    public function carBrand()
    {
        $carBrands = [
            'Acura', 'Alfa Romeo', 'Audi', 'Bentley', 'Bmw', 'Cadillac', 'Chery', 'Chevrolet', 'Chrysler', 'Citroën', 'Dacia',
            'Daewoo', 'Daihatsu', 'Dodge', 'Fiat', 'Ford', 'Ford Usa', 'Geely', 'Great Wall', 'Haval', 'Honda', 'Hummer', 'Hyundai',
            'Infiniti', 'Isuzu', 'Jaguar', 'Jeep', 'Kia', 'Lada', 'Lancia', 'Land Rover', 'Lexus', 'Mazda', 'Mercedes-Benz', 'Mini',
            'Mitsubishi', 'Nissan', 'Opel', 'Peugeot', 'Porsche', 'Renault', 'Renault Trucks', 'Rover', 'Saab', 'Seat', 'Skoda', 'Smart',
            'Ssangyong', 'Subaru', 'Suzuki', 'Tesla', 'Toyota', 'Volvo', 'Vw', 'Zaz',
        ];

        return $this->generator->randomElement($carBrands);
    }

    public function carModel($brand = null)
    {
        $carModels = [
            'Acura' => ['MDX', 'RDX', 'TLX', 'ILX', 'NSX'],
            'Alfa Romeo' => ['Giulia', 'Stelvio', 'Giulietta', '4C', 'MiTo'],
            'Audi' => ['A4', 'A6', 'Q5', 'Q7', 'TT'],
            'Bentley' => ['Continental GT', 'Bentayga', 'Flying Spur', 'Mulsanne', 'Arnage'],
            'Bmw' => ['3 Series', '5 Series', 'X5', 'X3', '7 Series'],
            'Cadillac' => ['Escalade', 'XT5', 'CT6', 'CTS', 'XT4'],
            'Chery' => ['Tiggo 8', 'Arrizo 5', 'Tiggo 7', 'Arrizo 7', 'Tiggo 3'],
            'Chevrolet' => ['Camaro', 'Malibu', 'Equinox', 'Silverado', 'Tahoe'],
            'Chrysler' => ['300', 'Pacifica', 'Voyager', 'Aspen', 'Sebring'],
            'Citroën' => ['C3', 'C4', 'C5 Aircross', 'Berlingo', 'DS3'],
            'Dacia' => ['Duster', 'Logan', 'Sandero', 'Dokker', 'Lodgy'],
            'Daewoo' => ['Matiz', 'Lanos', 'Nexia', 'Leganza', 'Espero'],
            'Daihatsu' => ['Terios', 'Sirion', 'Charade', 'Copen', 'Mira'],
            'Dodge' => ['Charger', 'Challenger', 'Durango', 'Ram 1500', 'Journey'],
            'Fiat' => ['500', 'Panda', 'Tipo', 'Punto', 'Doblo'],
            'Ford' => ['Fiesta', 'Focus', 'Mustang', 'Explorer', 'F-150'],
            'Ford Usa' => ['Edge', 'Expedition', 'Fusion', 'Escape', 'Ranger'],
            'Geely' => ['Atlas', 'Emgrand GT', 'Coolray', 'Emgrand X7', 'Tugella'],
            'Great Wall' => ['Haval H6', 'Haval H2', 'Wingle 7', 'Haval H9', 'Steed 5'],
            'Haval' => ['H6', 'F7', 'Jolion', 'H2', 'H9'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'HR-V', 'Fit'],
            'Hummer' => ['H1', 'H2', 'H3', 'H3T', 'HX (Concept)'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Kona'],
            'Infiniti' => ['Q50', 'QX60', 'QX80', 'QX50', 'Q60'],
            'Isuzu' => ['D-Max', 'MU-X', 'Trooper', 'Rodeo', 'Axiom'],
            'Jaguar' => ['XE', 'XF', 'F-Pace', 'E-Pace', 'F-Type'],
            'Jeep' => ['Wrangler', 'Grand Cherokee', 'Renegade', 'Compass', 'Cherokee'],
            'Kia' => ['Rio', 'Sportage', 'Sorento', 'Soul', 'Optima'],
            'Lada' => ['Vesta', 'Granta', 'Niva', 'XRay', 'Kalina'],
            'Lancia' => ['Ypsilon', 'Delta', 'Thema', 'Voyager', 'Musa'],
            'Land Rover' => ['Range Rover', 'Discovery', 'Defender', 'Range Rover Sport', 'Range Rover Evoque'],
            'Lexus' => ['RX', 'NX', 'ES', 'LS', 'GX'],
            'Mazda' => ['Mazda3', 'Mazda6', 'CX-5', 'CX-9', 'MX-5'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLE', 'GLC', 'S-Class'],
            'Mini' => ['Cooper', 'Countryman', 'Clubman', 'Paceman', 'Convertible'],
            'Mitsubishi' => ['Outlander', 'Lancer', 'Pajero', 'Eclipse Cross', 'ASX'],
            'Nissan' => ['Altima', 'Sentra', 'Rogue', 'Qashqai', 'Pathfinder'],
            'Opel' => ['Astra', 'Corsa', 'Insignia', 'Mokka', 'Zafira'],
            'Peugeot' => ['208', '308', '3008', '508', '2008'],
            'Porsche' => ['911', 'Cayenne', 'Macan', 'Panamera', 'Taycan'],
            'Renault' => ['Clio', 'Megane', 'Captur', 'Kadjar', 'Koleos'],
            'Renault Trucks' => ['T-Series', 'C-Series', 'D-Series', 'K-Series', 'Master'],
            'Rover' => ['75', '45', '25', 'Streetwise', 'Metro'],
            'Saab' => ['9-3', '9-5', '900', '9-4X', '9-7X'],
            'Seat' => ['Ibiza', 'Leon', 'Ateca', 'Arona', 'Tarraco'],
            'Skoda' => ['Octavia', 'Fabia', 'Kodiaq', 'Superb', 'Karoq'],
            'Smart' => ['Fortwo', 'Forfour', 'Roadster', 'Crossblade', 'Fortwo Cabrio'],
            'Ssangyong' => ['Tivoli', 'Rexton', 'Korando', 'Actyon', 'Musso'],
            'Subaru' => ['Forester', 'Outback', 'Impreza', 'WRX', 'Ascent'],
            'Suzuki' => ['Swift', 'Vitara', 'SX4', 'Jimny', 'Celerio'],
            'Tesla' => ['Model S', 'Model 3', 'Model X', 'Model Y', 'Cybertruck'],
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Land Cruiser', 'Highlander'],
            'Volvo' => ['XC60', 'XC90', 'S60', 'V60', 'V90'],
            'Vw' => ['Golf', 'Passat', 'Tiguan', 'Jetta', 'Polo'],
            'Zaz' => ['Lanos', 'Sens', 'Vida', 'Forza', 'Slavuta'],
        ];

        if ($brand === null) {
            $brand = $this->carBrand();
        }

        return $this->generator->randomElement($carModels[$brand]);
    }

    public function carPart()
    {
        $carParts = [
            'Двигун', 'Трансмісія', 'Гальма', 'Підвіска', 'Радіатор', 'Стартер', 'Генератор', 'Паливний насос',
            'Фільтр повітряний', 'Фільтр мастильний', 'Ремінь ГРМ', 'Ланцюг ГРМ', 'Водяний насос', 'Коробка передач',
            'Каталізатор', 'Вихлопна труба', 'Амортизатор', 'Маятниковий підшипник', 'Паличка рульова', 'Тяга',
            'Підшипник ступиці', 'Вал привідний', 'Рейка кермова', 'Насос рульового управління', 'Акумулятор', 'Свічки запалювання',
            'Котушка запалювання', 'Термостат', 'Шланг системи охолодження', 'Дворникові леза', 'Лампа фари', 'Фара задня',
            'Бічне дзеркало', 'Ручка двері', 'Регулятор скла', 'Бак пального', 'Форсунка палива', 'Лямбда-зонд',
        ];

        return $this->generator->randomElement($carParts);
    }
}
