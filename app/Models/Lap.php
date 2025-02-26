<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lap extends Model
{
    protected $table = 'laps';

    protected $fillable = [
        'race_id',
        'driver_id',
        'duration',
        'number',
    ];

    protected $casts = [
        'duration' => 'integer',
        'number' => 'integer',
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
