<?php

namespace App\Http\Requests\TypeUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
        ];
    }
    /**
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name field is required',
            'name.max' => 'You passed the maximum character value (value is 255)',
            'description.required' => 'Description field is required',
        ];
    }
}
