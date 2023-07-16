<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Takleef;

class TakleefTable implements FromCollection, WithMapping, WithHeadings
{
    protected $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function map($tableData): array
    {
        return [
            $tableData->id,
            $tableData->employee->fileNo,
            $tableData->date,
            $tableData->created_at,
            // Include other columns as needed
        ];
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
