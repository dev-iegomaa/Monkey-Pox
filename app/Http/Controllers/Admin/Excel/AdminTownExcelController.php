<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\Excel\AdminTownExcelInterface;
use App\Http\Requests\Admin\Excel\Town\ImportTownRequest;

class AdminTownExcelController extends Controller
{
    private $townInterface;
    public function __construct(AdminTownExcelInterface $townInterface)
    {
        $this->townInterface = $townInterface;
    }

    public function import(ImportTownRequest $request)
    {
        return $this->townInterface->import($request);
    }

    public function export()
    {
        return $this->townInterface->export();
    }
}
