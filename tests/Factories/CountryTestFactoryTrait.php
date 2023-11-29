<?php

namespace Tests\Factories;

use App\Models\Country;

trait CountryTestFactoryTrait
{
    protected function generateRandomCountry()
    {
        if (Country::count() > 0) {
            return Country::first();
        }
        return Country::factory()->create();
    }
}
