<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\Excel\AdminCityExcelInterface;
use App\Http\Requests\Admin\Excel\City\ImportCityRequest;

class AdminCityExcelController extends Controller
{
    private $cityInterface;
    public function __construct(AdminCityExcelInterface $cityInterface)
    {
        $this->cityInterface = $cityInterface;
    }

    public function import(ImportCityRequest $request)
    {
        return $this->cityInterface->import($request);
    }

    public function export()
    {
        return  $this->cityInterface->export();
    }
}
