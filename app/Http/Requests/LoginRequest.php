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
        if (app()->isLocale('ru')) {
            return [
                'name' => 'Логин',
                'remember' => 'Чекбокс'
            ];
        }
        return parent::attributes();
    }
}
