<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\EndUser\DiagnosisInterface;
use App\Http\Requests\EndUser\Diagnosis\CreateDiagnosisRequest;
use App\Http\Services\Diagnosis\DiagnosisUploadImageService;

class DiagnosisController extends Controller
{
    private $diagnosisInterface;
    public function __construct(DiagnosisInterface $interface)
    {
        $this->diagnosisInterface = $interface;
    }

    public function diagnosis(CreateDiagnosisRequest $request, DiagnosisUploadImageService $service)
    {
        return $this->diagnosisInterface->diagnosis($request, $service);
    }
}
