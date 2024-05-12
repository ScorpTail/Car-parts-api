<?php

namespace App\Orchid\Layouts\Brands;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

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
        ];
    }
}
