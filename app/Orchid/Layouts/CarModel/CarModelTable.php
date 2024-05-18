<?php

namespace App\Orchid\Layouts\CarModel;

use Orchid\Screen\TD;
use App\Models\CarModel;
use App\Services\ImageServices\ImageService;
use Orchid\Support\Color;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Illuminate\Database\Eloquent\Model;

class CarModelTable extends Table
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
    protected $target = 'carModels';

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

            TD::make('checkCarModelPhoto', 'Фото Автомобіля')
                ->width('50px')
                ->render(fn (CarModel $carModel) => $this->linkToTheImage($carModel)),

            TD::make('brand_id', 'Назва бренду машини')
                ->render(fn ($model) => $model->brand->name),

            TD::make('name', 'Модель машини'),

            TD::make('actions', 'Дії')
                ->width('300px')
                ->align(TD::ALIGN_CENTER)
                ->render(function (CarModel $carModel) {
                    return Group::make([
                        ModalToggle::make('Редагувати')
                            ->modalTitle('Редагувати модель: ' . $carModel->name)
                            ->modal('updateCarModel')
                            ->method('update')
                            ->asyncParameters(['carModel' => $carModel->id])
                            ->icon('pencil'),
                        Button::make('Видалити')
                            ->method('destroy')
                            ->confirm('Ви впевнені, що хочете видалити цю модель?')
                            ->parameters(['carModel' => $carModel->id])
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
