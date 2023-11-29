<?php

namespace App\Imports;

use App\Models\Town;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TownImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Town([
            'name' => $row['name'],
            'city_id' => $row['city_id']
        ]);
    }

    public function rules(): array
    {
        return Town::createRule();
    }
}
