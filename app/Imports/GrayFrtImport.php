<?php

namespace App\Imports;

use App\Imports\Sales\GrayFrtImport as GFI;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class GrayFrtImport implements WithMultipleSheets, WithProgressBar
{
    use Importable, WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'gray frt (3)' => new GFI()
        ];
    }
}
