<?php

namespace App\Http\Interfaces\EndUser;

interface DiagnosisInterface
{
    public function diagnosis($request, $service);
}
