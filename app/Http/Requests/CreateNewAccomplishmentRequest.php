<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewAccomplishmentRequest extends FormRequest
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
            'input-task' => 'required | string',
            'input-accomplishment' => 'required | string',
            'input-month' => 'required | string',
            'input-day' => 'required | integer',
            'input-year' => 'required | integer',
            'input-time-started' => 'required | string',
            'input-time-ended' => 'required | string',
            'input-remarks' => 'required | string',
        ];
    }
}
