<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\DiagnosisInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\Diagnosis\DiagnosisTrait;
use App\Models\Diagnosis;
use App\Models\MedicalDiagnosis;
use Illuminate\Support\Facades\Http;

class DiagnosisRepository implements DiagnosisInterface
{
    private $diagnosisModel;
    use ApiResponseTrait, DiagnosisTrait;
    public function __construct(Diagnosis $diagnosis)
    {
        $this->diagnosisModel = $diagnosis;
    }

    public function diagnosis($request, $service)
    {
        $imageName = $service->uploadImage($request->image);
        $diagnosis = $this->diagnosisModel::create([
            'image' => $imageName,
            'patient_id' => auth('patient')->user()->id
        ]);

        $image = $diagnosis->getRawOriginal('image');
        $medicalDiagnosis = Http::post('http://127.0.0.1:5000/prediction', ['image' => $image])->json();

        MedicalDiagnosis::create([
            'degree' => $medicalDiagnosis,
            'patient_id' => auth('patient')->user()->id
        ]);

        return $this->apiResponse(200,'Radiography Degree', null, [
            'degree' => $medicalDiagnosis
        ]);
    }
}
