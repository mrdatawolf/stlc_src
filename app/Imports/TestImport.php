<?php

namespace App\Imports;

use App\Imports\Sales\GrayFrtImport;
use App\Imports\Sales\OrdersImport;
use App\Imports\Sales\TMCImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class TestImport implements WithMultipleSheets, SkipsUnknownSheets, WithChunkReading, WithProgressBar
{
    use Importable;

    public function sheets(): array
    {
        return [
            0 => new TMCImport(),
            1 => new GrayFrtImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        //info("Sheet {$sheetName} was skipped");
    }

    public function chunkSize(): int
    {
        return 20;
    }
}
