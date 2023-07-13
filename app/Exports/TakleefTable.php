<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Takleef;

class TakleefTable implements FromQuery, WithMapping
{
    use Exportable;

    public function query()
    {
        return Takleef::query()->with('employee:id,fileNo');
    }

    public function map($tableData): array
    {
        return [
            $tableData->id,
            $tableData->employee->fileNo,
            $tableData->date,

            // Include other columns as needed
        ];
    }
}
