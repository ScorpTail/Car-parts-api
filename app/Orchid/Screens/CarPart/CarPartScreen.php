<?php

namespace App\Orchid\Screens\CarPart;

use App\Models\Part;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use App\Orchid\Layouts\CarPart\CarPartRows;
use App\Orchid\Layouts\CarPart\CarPartTable;
use App\Http\Requests\CarPart\CarPartRequest;

class CarPartScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'carParts' => Part::paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Запчастини для машин';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати запчастину')
                ->modal('createCarPart')
                ->method('store')
                ->modalTitle('Додавання новичх запчастин')
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
            CarPartTable::class,
            Layout::modal('createCarPart', CarPartRows::class)
                ->applyButton('Додати'),
            Layout::modal('updateCarPart', CarPartRows::class)
                ->applyButton('Додати')
                ->async('asyncGetCarPart'),
        ];
    }

    public function store(CarPartRequest $request)
    {
        $data = $request->validated();

        $carPart = Part::create($data['carPart']);

        $carPart->attachment()->syncWithoutDetaching(
            $request->input('carPart.image_path')
        );

        Toast::success('Нову модель успішно додано');
    }

    public function update(Part $carPart, CarPartRequest $request)
    {
        $data = $request->validated();
        $carPart->update($data['carPart']);
        Toast::success('Модель оновлено успішно');
    }

    public function destroy(Part $carPart)
    {
        $carPart->delete();
        Toast::success('Модель було видалено');
    }

    public function asyncGetCarPart(Part $carPart): array
    {
        $carPart->load('attachment');
        return [
            'carPart' => $carPart
        ];
    }
}
