<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AdminCountryInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\Country\CountryTrait;
use App\Models\Country;

class AdminCountryRepository implements AdminCountryInterface
{
    use ApiResponseTrait, CountryTrait;
    private $countryModel;

    public function __construct(Country $country)
    {
        $this->countryModel = $country;
    }

    public function index()
    {
        $country = $this->getCountries();
        return $this->apiResponse(200, 'Country Data', null, $country);
    }

    public function create($request)
    {
        $country = $this->countryModel::create([
            'name' => strtoupper($request->name),
            'iso' => strtoupper($request->iso),
            'code' => $request->code
        ]);
        return $this->apiResponse(200, 'Country Was Created', null, $country);
    }

    public function delete($request)
    {
        $this->findCountry($request->id)->delete();
        return $this->apiResponse(200, 'Country Was Deleted');
    }

    public function update($request)
    {
        $this->findCountry($request->id)->update([
            'name' => strtoupper($request->name),
            'iso' => strtoupper($request->iso),
            'code' => $request->code
        ]);
        return $this->apiResponse(200, 'Country Was Updated');
    }
}
