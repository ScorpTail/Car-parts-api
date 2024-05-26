<?php

namespace App\Orchid\Layouts\CarModel;

use App\Models\Brand;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;

class CarModelInput extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('carModel.name')
                ->title('Назва моделі')
                ->placeholder('Введіть назву моделі автомобіля')
                ->required(),
            Relation::make('carModel.brand_id')
                ->fromModel(Brand::class, 'name')
                ->title('Марка машини')
                ->placeholder('Оберіть марку мащини...')
                ->required(),
            Picture::make('carModel.image_path')
                ->acceptedFiles('image/*')
                ->maxFileSize(8)
                ->placeholder('Зображення бренду')
                ->help('Додайте зображення бренду')
                ->title('Бренд')
                ->required(),
        ];
    }
}
