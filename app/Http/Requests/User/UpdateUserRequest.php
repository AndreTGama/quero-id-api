<?php

namespace App\Http\Requests\User;

use App\Rules\User\FullName;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required','max:255', new FullName],
            'email' => 'required|unique:users|max:255',
            'profile_public' => 'required|boolean'
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
            'email.required' => 'E-mail field is required',
            'email.max' => 'You passed the maximum character value (value is 255)',
            'profile_public.required' => 'Profile field is required',
            'profile_public.boolean' => 'Profile field is boolean',
        ];
    }
}
