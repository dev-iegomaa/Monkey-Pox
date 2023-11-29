<?php

namespace App\Http\Repositories\Admin\Excel;

use App\Exports\FaqExport;
use App\Http\Interfaces\Admin\Excel\AdminFaqExcelInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Imports\FaqImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminFaqExcelRepository implements AdminFaqExcelInterface
{
    use ApiResponseTrait;
    public function import($request)
    {
        Excel::import(new FaqImport, $request->file);
        return $this->apiResponse(200, 'Faqs File Is Uploaded Successfully');
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new FaqExport, 'faqs.xlsx');
    }
}
