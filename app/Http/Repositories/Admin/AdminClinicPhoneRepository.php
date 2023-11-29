<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminClinicPhoneInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\ClinicPhone\ClinicPhoneTrait;
use App\Http\Traits\Doctor\DoctorTrait;
use App\Http\Traits\Redis\DoctorRedis;
use App\Models\ClinicPhone;
use App\Models\Doctor;

class AdminClinicPhoneRepository implements AdminClinicPhoneInterface
{
    private $clinicPhoneModel;
    private $doctorModel;
    use ApiResponseTrait, ClinicPhoneTrait, DoctorRedis, DoctorTrait;
    public function __construct(ClinicPhone $clinicPhone, Doctor $doctor)
    {
        $this->clinicPhoneModel = $clinicPhone;
        $this->doctorModel = $doctor;
    }

    public function index()
    {
        $clinicPhones = $this->getClinicPhones();
        return $this->apiResponse(200, 'Clinic Phones Data', null, $clinicPhones);
    }

    public function create($request)
    {
        $clinicPhone = $this->clinicPhoneModel::create([
            'phone' => $request->phone,
            'clinic_id' => $request->clinic_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Clinic Phone Was Created', null, $clinicPhone);
    }

    public function delete($request)
    {
        $this->findClinicPhone($request->id)->delete();
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Clinic Phone Was Deleted');
    }

    public function update($request)
    {
        $this->findClinicPhone($request->id)->update([
            'phone' => $request->phone,
            'clinic_id' => $request->clinic_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Clinic Phone Was Updated');
    }
}
