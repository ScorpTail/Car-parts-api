<?php

namespace App\Orchid\Layouts\Brands;

use App\Models\Brand;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageServices\ImageService;

class BrandTable extends Table
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
    protected $target = 'brands';

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
                ->alignCenter()
                ->cantHide()
                ->render(function (Model $model, object $loop) {
                    return $loop->iteration;
                }),

            TD::make('id', 'ID')
                ->width('100px')
                ->alignCenter(),

            TD::make('checkBrandsPhoto', 'Фото бренду')
                ->width('50px')
                //->alignLeft()
                ->render(fn (Brand $brand) => Group::make([$this->linkToTheImage($brand)])),

            TD::make('name', 'Назва бренду машини'),

            TD::make('actions', 'Дії')
                ->width('300px')
                ->align(TD::ALIGN_CENTER)
                ->render(function (Brand $brand) {
                    return Group::make([
                        ModalToggle::make('Редагувати')
                            ->modalTitle('Редагувати бренд: ' . $brand->name)
                            ->modal('updateBrand')
                            ->method('update')
                            ->asyncParameters([
                                'brand' => $brand->id
                            ])
                            ->icon('pencil'),
                        Button::make('Видалити')
                            ->method('destroy')
                            ->confirm('Ви впевнені, що хочете видалити цей бренд?')
                            ->parameters(['brand' => $brand->id])
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
