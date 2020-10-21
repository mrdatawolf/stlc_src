<?php namespace App\Imports;

use App\Imports\Sales\TMCImport as TI;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class TMCImport implements WithMultipleSheets, WithProgressBar
{
    use Importable, WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'TMC' => new TI(),
        ];
    }
}
