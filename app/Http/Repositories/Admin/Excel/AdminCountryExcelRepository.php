<?php

namespace App\Http\Repositories\Admin\Excel;

use App\Exports\CountryExport;
use App\Http\Interfaces\Admin\Excel\AdminCountryExcelInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Imports\CountryImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminCountryExcelRepository implements AdminCountryExcelInterface
{
    use ApiResponseTrait;
    public function import($request)
    {
        Excel::import(new CountryImport, $request->file);
        return $this->apiResponse(200, 'Country File Is Uploaded Successfully');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new CountryExport, 'country.xlsx');
    }
}
