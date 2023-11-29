<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\Excel\AdminCountryExcelInterface;
use App\Http\Requests\Admin\Excel\Country\ImportCountryRequest;

class AdminCountryExcelController extends Controller
{
    private $countryInterface;
    public function __construct(AdminCountryExcelInterface $countryInterface)
    {
        $this->countryInterface = $countryInterface;
    }

    public function import(ImportCountryRequest $request)
    {
        return $this->countryInterface->import($request);
    }

    public function export()
    {
        return $this->countryInterface->export();
    }
}
