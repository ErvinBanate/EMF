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
            'input-month' => 'required | string',
            'input-day' => 'required | integer',
            'input-year' => 'required | integer',
            'input-fire-alarm-level' => 'required | string',
            'input-cause-of-incident' => 'required | string',
            'input-estimated-damage' => 'required | integer',
            'input-reported-by' => 'required | integer',
            'input-description' => 'required | string',
            'input-baranggay' => 'required | string',
            'input-location' => 'required | string',
        ];
    }
}
