<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spread extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function spreadDescription(): HasMany
    {
        return $this->hasMany(SpreadDescription::class, 'spread_id', 'id');
    }
}
