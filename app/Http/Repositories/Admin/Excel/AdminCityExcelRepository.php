<?php

namespace App\Http\Repositories\Admin\Excel;

use App\Exports\CityExport;
use App\Http\Interfaces\Admin\Excel\AdminCityExcelInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Imports\CityImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminCityExcelRepository implements AdminCityExcelInterface
{
    use ApiResponseTrait;
    public function import($request)
    {
        Excel::import(new CityImport, $request->file);
        return $this->apiResponse(200, 'City File Is Uploaded Successfully');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new CityExport, 'cities.xlsx');
    }
}
