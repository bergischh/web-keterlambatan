<?php

namespace App\Exports;

use App\Models\Late;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; 

class ExportLate implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Late::with('student')->get();

    }

    public function headings(): array
    {
        return [
            "Nis", "Nama", "Rombel", "Rayon", "Total Keterlambatan"
        ];
    }

    public function map($item): array
    {
        $student = Late::where('siswa_id', $late->siswa_id)->first();

        return [
            $item->student->nis,
            $item->student->name,
            $item->student->rombel,
            $item->student->rayon,
            $item->total_late,
        ];
    }

}
