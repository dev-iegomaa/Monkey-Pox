<?php

namespace App\Http\Interfaces\Admin\Excel;

interface AdminCityExcelInterface
{
    public function import($request);
    public function export();
}
