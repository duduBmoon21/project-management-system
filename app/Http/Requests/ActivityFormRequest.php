<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityFormRequest extends FormRequest
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
            //
            'name' => 'required' ,
            'start_date' => 'required|after_or_equal:today' ,
            'end_date' => 'required|after:start_date' ,
            
            'description' => 'required',
      
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is Must',
            'name.min' => 'Name Must be 5 Chr.',
        ];
    }
}
