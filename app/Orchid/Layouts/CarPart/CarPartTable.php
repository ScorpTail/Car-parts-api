<?php

namespace App\Orchid\Layouts\CarPart;

use App\Models\Part;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Color;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageServices\ImageService;

class CarPartTable extends Table
{
    public function __construct(private ImageService $service)
    {
    }
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'carParts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('#', '#')
                ->align(TD::ALIGN_LEFT)
                ->cantHide()
                ->render(function (Model $model, object $loop) {
                    return $loop->iteration;
                }),

            TD::make('id', 'ID')
                ->align(TD::ALIGN_LEFT),

            TD::make('checkCarModelPhoto', 'Фото деталі')
                ->width('50px')
                ->render(fn (Part $part) => $this->linkToTheImage($part)),

            TD::make('model_id', 'Назва моделі машини')
                ->render(fn ($model) => $model->model->name),

            TD::make('name', 'Назва деталі'),
            TD::make('country_production', 'Країна виробник'),

            TD::make('actions', 'Дії')
                ->width('300px')
                ->align(TD::ALIGN_CENTER)
                ->render(function (Part $part) {
                    return Group::make([
                        ModalToggle::make('Редагувати')
                            ->modalTitle('Редагувати модель: ' . $part->name)
                            ->modal('updateCarPart')
                            ->method('update')
                            ->asyncParameters(['carPart' => $part->id])
                            ->icon('pencil'),
                        Button::make('Видалити')
                            ->method('destroy')
                            ->confirm('Ви впевнені, що хочете видалити цю модель?')
                            ->parameters(['carPart' => $part->id])
                            ->icon('trash')
                            ->type(COLOR::DANGER),
                    ])->autoWidth();
                }),
        ];
    }

    private function linkToTheImage($model): Group
    {
        $fileExists = $this->service->isImageExists($model);
        return $fileExists
            ? Group::make([
                Link::make()
                    ->href($model->image_path)
                    ->target('_blank')
                    ->asyncParameters(['carModel' => $model->id])
                    ->icon('bs.box-arrow-up-right')
            ])
            : Group::make([]);
    }
}
