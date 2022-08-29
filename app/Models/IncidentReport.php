<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentReport extends Model
{
    const EMPLOYEE = 'Employee';
    const TEAMLEADER = 'Team Leader';
    const ADMIN = 'Admin';

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'date',
        'fire_alarm_level',
        'cause_of_incident',
        'estimated_damage',
        'reported_by',
        'description',
        'is_approved',
        'is_rejected',
        'baranggay',
        'location',
    ];

    public function reportedBy():BelongsTo 
    {
        return $this->belongsTo(User::class, 'reported_by', 'id');
    }
}
