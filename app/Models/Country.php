<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'iso'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function createRule(): array
    {
        return [
            'name' => 'required|string|max:255|unique:countries,name',
            'iso' => 'required|string|unique:countries,iso',
            'code' => 'required|regex:/[\d\-]+/'
        ];
    }

    public function city(): HasMany
    {
        return $this->hasMany(City::class, 'city_id', 'id');
    }

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class, 'country_id', 'id');
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class, 'town_id', 'id');
    }
}
