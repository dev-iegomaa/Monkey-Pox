<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\DoctorInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\Country\CountryTrait;
use App\Http\Traits\Redis\DoctorRedis;
use App\Models\Country;
use App\Models\Doctor;

class DoctorRepository implements DoctorInterface
{
    private $doctorModel;
    private $countryModel;
    use ApiResponseTrait, DoctorRedis, CountryTrait;
    public function __construct(Doctor $doctor, Country $country)
    {
        $this->doctorModel = $doctor;
        $this->countryModel = $country;
    }

    public function getCountriesData()
    {
        $countries = $this->getCountries();
        return $this->apiResponse(200, 'Countries Data', null, $countries);
    }

    public function index()
    {
        $doctors = $this->getDoctorsFromRedis();
        $doctors = collect($doctors)->where('status', 'available');
        $filtered = $doctors->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'image' => $doctor->image
            ];
        });
        return $this->apiResponse(200, 'Doctors Data', null, $filtered);
    }

    public function find($id)
    {
        $doctors = $this->getDoctorsFromRedis();
        $doctor = collect($doctors)->where('id', $id)->first();
        return $this->apiResponse(200, 'Doctors Data', null, $doctor);
    }

    public function apply($request, $service)
    {
        $imageName = $service->uploadImage($request->image);
        $cardImage = $service->uploadImage($request->medical_syndicate_card);
        $this->doctorModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imageName,
            'gender' => $request->gender,
            'highest_certificate' => $request->highest_certificate,
            'syndicate_number' => $request->syndicate_number,
            'country_id' => $request->country_id,
            'description' => $request->description,
            'medical_syndicate_card' => $cardImage,
            'status' => 'under_review'
        ]);
        return $this->apiResponse(200, 'Welcome With Us, The Data Is Being Reviewed And When We Confirm It, We Will Contact You, Thank You');
    }
}
