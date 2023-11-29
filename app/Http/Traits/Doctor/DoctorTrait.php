<?php

namespace App\Http\Traits\Doctor;

trait DoctorTrait
{
    private function getDoctors()
    {
        return $this->doctorModel::with('country')->get();
    }

    private function findDoctors($id)
    {
        return $this->doctorModel::with('country')->find($id);
    }
}
