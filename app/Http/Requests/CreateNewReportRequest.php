<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required | date',
            'fire_alarm_level' => 'required | string',
            'cause_of_incident' => 'required | string',
            'estimated_damage' => 'required | integer',
            'reported_by' => 'required | integer',
            'description' => 'required | string',
            'is_approved' => 'nullable | boolean',
            'is_rejected' => 'nullable | boolean',
            'baranggay' => 'required | string',
            'location' => 'required | string',
        ];
    }
}
