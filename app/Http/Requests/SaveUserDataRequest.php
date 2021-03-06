<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserDataRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|regex:/^.+@.+$/i',
            'role_id' => 'required|numeric'
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
