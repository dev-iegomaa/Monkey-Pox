<?php

namespace Tests\Factories;

use App\Models\News;

trait NewsTestFactoryTrait
{
    protected function generateRandomNews()
    {
        if (News::count() > 0) {
            return News::first();
        }
        return News::factory()->create();
    }
}
