<?php

namespace App\Orchid\Layouts\CarModel;

use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Illuminate\Database\Eloquent\Model;

class CarModelTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'models';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('#', '#')
                ->width('100px')
                ->align(TD::ALIGN_LEFT)
                ->cantHide()
                ->render(function (Model $model, object $loop) {
                    return $loop->iteration;
                }),

            TD::make('id', 'ID')
                ->align(TD::ALIGN_LEFT),

            TD::make('brand_id', 'Назва бренду машини')
                ->render(fn ($model) => $model->brand->name),

            TD::make('name', 'Модель машини'),

            TD::make('actions', 'Дії')
                ->width('300px')
                ->align(TD::ALIGN_CENTER)
                ->render(function ($brand) {
                    return Group::make([
                        Link::make('Редагувати')->icon('pencil'),
                        Link::make('Видалити')->icon('trash')->type(Color::ERROR),
                    ])->autoWidth();
                }),
        ];
    }
}