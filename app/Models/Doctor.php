<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'image',
        'gender',
        'highest_certificate',
        'syndicate_number',
        'country_id',
        'description',
        'medical_syndicate_card',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function createRule(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg',
            'gender' => 'required|string|max:6|in:male,female',
            'highest_certificate' => 'required|string|max:255|in:msc,md,diploma,mbbch',
            'syndicate_number' => 'required|integer|unique:doctors,syndicate_number',
            'country_id' => 'required|integer|exists:countries,id',
            'description' => 'required|string',
            'medical_syndicate_card' => 'required|image|mimes:png,jpg,webp,jpeg'
        ];
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certification::class, 'doctor_id', 'id');
    }

    public function awards(): HasMany
    {
        return $this->hasMany(Award::class, 'doctor_id', 'id');
    }

    public function clinics(): HasMany
    {
        return $this->hasMany(Clinic::class, 'doctor_id', 'id');
    }

    public function getImageAttribute($value): string
    {
        return 'uploaded/doctor/avatar/' . $value;
    }

    public function getMedicalSyndicateCardAttribute($value): string
    {
        return 'uploaded/doctor/card/' . $value;
    }
}
