<?php

namespace App\Http\Repositories\EndUser;

use App\Http\Interfaces\EndUser\PatientInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\Country\CountryTrait;
use App\Models\Country;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientInterface
{
    private $countryModel;
    use ApiResponseTrait, CountryTrait;
    public function __construct(Country $country)
    {
        $this->countryModel = $country;
    }

    public function getCountriesData()
    {
        $countries = $this->getCountries();
        return $this->apiResponse(200, 'Countries Data', null, $countries);
    }

    public function register($request)
    {
        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $request->country_id
        ]);
        return $this->apiResponse(200, 'Patient Was Created Successfully', null, $patient);
    }

    public function login($request)
    {
        $credentials = $request->only(['email', 'password']);
        if (! $token = auth('patient')->attempt($credentials)) {
            return $this->apiResponse(401, 'Unauthorized');
        }
        return $this->create_token($token);
    }

    public function logout()
    {
        auth('patient')->logout();
        return $this->apiResponse(200, 'Logout Successfully');
    }

    private function create_token($token)
    {
        $array = [
            'access_token' => $token,
            'patient' => auth('patient')->user()
        ];
        return $this->apiResponse(200, 'Login Successfully', null, $array);
    }
}
