<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomplishmentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'fire_truck',
        'month',
        'day',
        'year',
        'time_started',
        'time_ended',
        'task',
        'accomplishments',
        'remarks',
    ];
}
