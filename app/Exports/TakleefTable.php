<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Takleef;

class TakleefTable implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    protected $records;

    public function query()
    {
        return Takleef::query()->whereIn('id', $this->records->pluck('id')->toArray())->with('employee:id,fileNo');
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

    public function setRecords($records)
    {
        $this->records = $records;
        return $this;
    }

    public function headings(): array
    {
        return [
            'ID',
            'File No',
            'Date',
            // Include other column headings as needed
        ];
    }
}
