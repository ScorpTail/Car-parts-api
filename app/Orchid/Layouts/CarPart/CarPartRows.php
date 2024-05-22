<?php

namespace App\Orchid\Layouts\CarPart;

use App\Enum\StatusProductEnum;
use App\Models\Brand;
use App\Models\CarModel;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;

class CarPartRows extends Rows
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
            Input::make('carPart.article')
                ->title('Артикль продукту')
                ->readonly()
                ->value('This is a static label text')
                ->required(),
            Input::make('carPart.name')
                ->title('Назва деталі')
                ->placeholder('Введіть назву деталі автомобіля')
                ->required(),
            Input::make('carPart.country_production')
                ->title('Країна виробник')
                ->placeholder('Введіть країну виробника')
                ->required(),
            TextArea::make('carPart.description')
                ->rows(5)
                ->title('Опис деталі')
                ->placeholder('Введіть опис для деталі автомобіля')
                ->required(),
            Input::make('carPart.price')
                ->title('Ціна деталі')
                ->placeholder('Введіть ціну деталі')
                ->required(),
            Select::make('carPart.status')
                ->options([
                    StatusProductEnum::AVAIABLE->value => 'Присутній на складі',
                    StatusProductEnum::NOTAVAIABLE->value => 'Нема на складі',
                    StatusProductEnum::ENDED->value => 'Закінчилось',
                ])
                ->empty('Оберіть статус із списку...')
                ->title('Назва моделі')
                ->placeholder('Оберіть статус')
                ->required(),
            Relation::make('carPart.model_id')
                ->fromModel(CarModel::class, 'name')
                ->title('Марка машини')
                ->placeholder('Оберіть марку мащини...')
                ->required(),
            Picture::make('carPart.image_path')
                ->acceptedFiles('image/*')
                ->maxFileSize(1)
                ->title('Зображення деталі')
                ->required(),
            // Upload::make('carPart.image_path')
            //     ->title('Зображення деталі')
            //     ->required()
            //     ->acceptedFiles('image/*'),
        ];
    }
}
