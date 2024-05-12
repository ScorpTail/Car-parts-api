<?php

namespace App\Orchid\Screens\CarModel;

use App\Models\CarModel;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use App\Orchid\Layouts\CarModel\CarModelInput;
use App\Orchid\Layouts\CarModel\CarModelTable;
use App\Http\Requests\CarModel\CarModelRequest;

class CarModelScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'carModels' => CarModel::paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Моделі машин';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати нову модель автомобіля')
                ->modal('storeCarModel')
                ->method('store')
                ->icon('plus'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CarModelTable::class,
            Layout::modal('storeCarModel', CarModelInput::class)
                ->applyButton('Додати')
                ->title('Додати нову модель автомобілю'),

            Layout::modal('updateCarModel', CarModelInput::class)
                ->applyButton('Відредагувати')
                ->async('asyncGetCarModel'),
        ];
    }

    public function store(CarModelRequest $request)
    {
        $data = $request->validated();
        CarModel::create($data['carModel']);
        Toast::success('Нову модель успішно додано');
    }

    public function update(CarModel $carModel, CarModelRequest $request)
    {
        $data = $request->validated();
        $carModel->update($data['carModel']);
        Toast::success('Модель оновлено успішно');
    }

    public function destroy(CarModel $carModel)
    {
        $carModel->delete();
        Toast::success('Модель було видалено');
    }

    public function asyncGetCarModel(CarModel $carModel): array
    {
        return [
            'carModel' => $carModel
        ];
    }
}
