<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prevention extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function preventionDescription(): HasMany
    {
        return $this->hasMany(PreventionDescription::class, 'prevention_id', 'id');
    }
}
