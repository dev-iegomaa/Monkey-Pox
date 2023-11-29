<?php

namespace App\Exports;

use App\Models\Town;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TownExport implements FromView, WithStyles
{
    public function view(): View
    {
        $towns = Town::with(['city'])->get();
        return view('town.excel', compact('towns'));
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true]
            ]
        ];
    }
}
