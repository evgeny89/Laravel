<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'password' => 'required|min:8|max:255',
            'remember' => 'boolean'
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
                'remember' => __('validation.attributes.remember'),
            ];
    }
}
