<?php

namespace App\Http\Controllers\Admin\Excel;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\Excel\AdminFaqExcelInterface;
use App\Http\Requests\Admin\Excel\Faq\ImportFaqRequest;

class AdminFaqExcelController extends Controller
{
    private $faqInterface;
    public function __construct(AdminFaqExcelInterface $faqInterface)
    {
        $this->faqInterface = $faqInterface;
    }

    public function import(ImportFaqRequest $request)
    {
        return $this->faqInterface->import($request);
    }

    public function export()
    {
        return $this->faqInterface->export();
    }
}
