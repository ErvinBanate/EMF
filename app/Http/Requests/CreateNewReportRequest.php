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
            'input-start-month' => 'required | string',
            'input-start-day' => 'required | integer',
            'input-start-year' => 'required | integer',
            'input-start-time' => 'string | nullable',
            'input-end-month' => 'required | string',
            'input-end-day' => 'required | integer',
            'input-end-year' => 'required | integer',
            'input-end-time' => 'nullable | string',
            'input-families-affected' => 'integer | nullable',
            'input-fire-alarm-level' => 'required | string',
            'input-cause-of-incident' => 'string | nullable',
            'input-estimated-damage' => 'integer | nullable',
            'input-reported-by' => 'required | integer',
            'input-description' => 'string | nullable',
            'input-baranggay' => 'required | string',
            'input-location' => 'required | string',
            'input-image' => 'mimes:jpg,png,jpeg,gif,svg | nullable',
        ];
    }
}
