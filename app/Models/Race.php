<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

    protected $table = 'races';

    protected $fillable = [
        'happens_at',
        'place',
        'total_laps',
    ];

    protected $casts = [
        'happens_at' => 'datetime',
        'total_laps' => 'integer',
    ];

    public function laps(): HasMany
    {
        return $this->hasMany(Lap::class);
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }
}
