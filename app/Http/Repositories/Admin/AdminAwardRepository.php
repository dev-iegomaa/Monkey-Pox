<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminAwardInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\Award\AwardTrait;
use App\Http\Traits\Doctor\DoctorTrait;
use App\Http\Traits\Redis\DoctorRedis;
use App\Models\Award;
use App\Models\Doctor;

class AdminAwardRepository implements AdminAwardInterface
{
    use AwardTrait, ApiResponseTrait, DoctorRedis, DoctorTrait;
    private $awardModel;
    private $doctorModel;
    public function __construct(Award $award, Doctor $doctor)
    {
        $this->awardModel = $award;
        $this->doctorModel = $doctor;
    }

    public function index()
    {
        $awards = $this->getAwards();
        return $this->apiResponse(200, 'Award Data', null, $awards);
    }

    public function create($request)
    {
        $award = $this->awardModel::create([
            'award' => $request->award,
            'doctor_id' => $request->doctor_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Award Was Created', null, $award);
    }

    public function delete($request)
    {
        $this->findAward($request->id)->delete();
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Award Was Deleted');
    }

    public function update($request)
    {
        $this->findAward($request->id)->update([
            'award' => $request->award,
            'doctor_id' => $request->doctor_id
        ]);
        $this->setDoctorsIntoRedis();
        return $this->apiResponse(200, 'Award Was Updated');
    }
}
