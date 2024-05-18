<?php

namespace App\Orchid\Screens\Brands;

use App\Models\Brand;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Client\Request;
use Orchid\Screen\Actions\ModalToggle;

use App\Http\Requests\Barnd\BrandRequest;
use App\Orchid\Layouts\Brands\BrandInput;
use App\Orchid\Layouts\Brands\BrandTable;
use App\Services\PhotosServices\PhotosServices;

class BrandScreen extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'brands' => Brand::paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Марки машин';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Додати новий бренд')
                ->modal('createBrand')
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
            BrandTable::class,
            Layout::modal('createBrand', BrandInput::class)
                ->title('Додаваня нового бренду автомобіля')
                ->applyButton('Додати'),

            Layout::modal('updateBrand', BrandInput::class)
                ->applyButton('Відредагувати')
                ->async('asyncGetBrand'),
        ];
    }
    public function store(BrandRequest $request)
    {
        $data = $request->validated();
        Brand::create($data['brand']);
        Toast::info('Бренд успішно додано');
    }

    public function update(Brand $brand, BrandRequest $request)
    {
        $data = $request->validated();
        $brand->update($data['brand']);
        Toast::info('Бренд успішно змінено');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        Toast::info('Бренд успішно видалено');
    }

    public function asyncGetBrand(Brand $brand): array
    {
        return [
            'brand' => $brand
        ];
    }
}
