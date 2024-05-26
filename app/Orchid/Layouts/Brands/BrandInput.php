<?php

namespace App\Orchid\Layouts\Brands;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;

class BrandInput extends Rows
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
        // $brand = $this->query->get('brand');
        return [
            Input::make('brand.name')
                //->value($brand->name ?? null)
                ->placeholder('Вкажіть назву бренду')
                ->title('Назва бренду')
                ->required(),

            Picture::make('brand.image_path')
                ->acceptedFiles('image/*')
                ->maxFileSize(8)
                ->placeholder('Зображення бренду')
                ->help('Додайте зображення бренду')
                ->title('Бренд')
                ->required(),

            // Input::make('brand.photo')
            //     ->acceptedFiles('image/*')
            //     ->placeholder('Зображення бренду')
            //     ->help('Додайте зображення бренду')
            //     ->title('Бренд')
            //     ->type('file')
            //     ->required(),

            // Upload::make('brand.photo')
            //     ->acceptedFiles('image/*')
            //     //->maxFileSize(1024)
            //     ->maxFiles(4)
            //     ->groups('photo'),
        ];
    }
}
