<?php

namespace App\Imports;

use App\Imports\Sales\OrdersImport as OI;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class OrdersImport implements WithMultipleSheets, WithChunkReading, WithProgressBar
{
    use Importable, WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Orders' => new OI(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        //info("Sheet {$sheetName} was skipped");
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}
