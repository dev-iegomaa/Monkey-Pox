<?php

namespace App\Http\Interfaces\Admin\Excel;

interface AdminTownExcelInterface
{
    public function import($request);
    public function export();
}
