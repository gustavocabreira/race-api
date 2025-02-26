<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
