<?php

namespace App\Http\Interfaces\Admin\Excel;

interface AdminFaqExcelInterface
{
    public function import($request);
    public function export();
}
