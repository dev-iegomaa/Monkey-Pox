<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminCertificationInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\Certification\CertificationTrait;
use App\Http\Traits\Doctor\DoctorTrait;
use App\Http\Traits\Redis\DoctorRedis;
use App\Models\Certification;
use App\Models\Doctor;
use PhpParser\Comment\Doc;

class AdminCertificationRepository implements AdminCertificationInterface
{
    private $certificationModel;
    private $doctorModel;
    use ApiResponseTrait, CertificationTrait, DoctorRedis, DoctorTrait;
    public function __construct(Certification $certification, Doctor $doctor)
    {
        $this->certificationModel = $certification;
        $this->doctorModel = $doctor;
    }

    public function index()
    {
        $certifications = $this->getCertifications();
        return $this->apiResponse(200, 'Certification Data', null, $certifications);
    }

    public function create($request)
    {
        $certification = $this->certificationModel::create([
            'certificate' => $request->certificate,
            'place' => $request->place,
            'date' => $request->date,
            'doctor_id' => $request->doctor_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Certification Was Created', null, $certification);
    }

    public function delete($request)
    {
        $this->findCertification($request->id)->delete();
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Certification Was Deleted');
    }

    public function update($request)
    {
        $certificate = $this->findCertification($request->id);
        $certificate->update([
            'certificate' => $request->certificate ?? $certificate->certificate,
            'place' => $request->place ?? $certificate->place,
            'date' => $request->date ?? $certificate->date,
            'doctor_id' => $request->doctor_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Certification Was Updated');
    }
}
