<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminClinicDetailInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\ClinicDetail\ClinicDetailTrait;
use App\Http\Traits\Doctor\DoctorTrait;
use App\Http\Traits\Redis\DoctorRedis;
use App\Models\ClinicDetail;
use App\Models\Doctor;

class AdminClinicDetailRepository implements AdminClinicDetailInterface
{
    private $clinicDetailModel;
    private $doctorModel;
    use ClinicDetailTrait, ApiResponseTrait, DoctorTrait, DoctorRedis;
    public function __construct(ClinicDetail $clinicDetail, Doctor $doctor)
    {
        $this->clinicDetailModel = $clinicDetail;
        $this->doctorModel = $doctor;
    }

    public function index()
    {
        $clinicDetails = $this->getClinicDetails();
        return $this->apiResponse(200, 'Clinic Details Data', null, $clinicDetails);
    }

    public function create($request)
    {
        $clinicDetail = $this->clinicDetailModel::create([
            'days' => $request->days,
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'clinic_id' => $request->clinic_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Clinic Detail Was Created', null, $clinicDetail);
    }

    public function delete($request)
    {
        $this->findClinicDetail($request->id)->delete();
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Clinic Detail Was Deleted');
    }

    public function update($request)
    {
        $this->findClinicDetail($request->id)->update([
            'days' => $request->days,
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'clinic_id' => $request->clinic_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Clinic Detail Was Updated');
    }
}
