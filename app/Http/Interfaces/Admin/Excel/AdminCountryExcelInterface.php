<?php

namespace App\Http\Interfaces\Admin\Excel;

interface AdminCountryExcelInterface
{
    public function import($request);
    public function export();
}
