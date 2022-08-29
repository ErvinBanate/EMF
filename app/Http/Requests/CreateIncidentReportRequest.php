<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIncidentReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
            'fire_alarm_level' => "required|string",
            'cause_of_incident' => "required|string",
            'estimated_damage' => "required|integer",
            'reported_by' => "required|string",
            'description' => "required|string",
            'barangay' => "required|string",
            'block_no' => "required|string",
            'house_type' => "required|string",
            'is_approved' => "nullable|boolean",
            'is_rejected' => "nullable|boolean",
        ];
    }
}
