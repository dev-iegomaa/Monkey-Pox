<?php

namespace App\Http\Interfaces\EndUser;

interface DoctorInterface
{
    public function getCountriesData();
    public function index();
    public function find($id);
    public function apply($request, $service);
}
