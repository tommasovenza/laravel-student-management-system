<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct(array $studentIds)
    {
        // $this->year = $year;
        $this->studentIds = $studentIds;
    }

    public function query()
    {
        return Student::query()->whereIn('id', $this->studentIds);
    }

    /**
     * @param Student $student
     */
    public function map($student): array
    {
        return [
            $student->name,
            $student->email,
            $student->class->name,
            $student->section->name,
            $student->created_at->format('d/m/Y'),
        ];
    }

    // Excel Heading
    public function headings(): array
    {
        return [
            'name',
            'email',
            'class_id',
            'section_id',
            'created_at'
        ];
    }
}
