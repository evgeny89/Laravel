<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|unique:users,name|min:3|max:255',
            'email' => 'required|unique:users,email|regex:/^.+@.+$/i',
            'password' => 'required|min:8|max:255'
        ];
    }

    /**
     * Get the validation attributes that apply to the request
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.login'),
        ];
    }
}
