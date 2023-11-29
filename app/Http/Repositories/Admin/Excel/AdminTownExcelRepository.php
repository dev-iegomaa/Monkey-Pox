<?php

namespace App\Http\Repositories\Admin\Excel;

use App\Exports\TownExport;
use App\Http\Interfaces\Admin\Excel\AdminTownExcelInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Imports\TownImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminTownExcelRepository implements AdminTownExcelInterface
{
    use ApiResponseTrait;
    public function import($request)
    {
        Excel::import(new TownImport, $request->file);
        return $this->apiResponse(200, 'Towns File Is Uploaded Successfully');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new TownExport, 'town.xlsx');
    }
}
