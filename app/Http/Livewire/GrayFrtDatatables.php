<?php namespace App\Http\Livewire;

use App\Models\GrayFrt;
use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class GrayFrtDatatables extends LivewireDatatable
{
    public $model = GrayFrt::class;

    /**
     * @return array|mixed
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')
                        ->label('ID')
                        ->sortBy('id'),

            Column::name('town'),
            Column::name('miles'),
            NumberColumn::name('rate'),
            NumberColumn::name('value'),

            DateColumn::name('created_at')
                      ->label('Creation Date'),
            DateColumn::name('updated_at')
                      ->label('Updated Date')
        ];
    }
}
