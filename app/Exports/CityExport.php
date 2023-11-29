<?php

namespace App\Exports;

use App\Models\city;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CityExport implements FromView, WithStyles
{
    public function view(): View
    {
        $cities = City::with(['country'])->get();
        return view('city.excel', compact('cities'));
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
