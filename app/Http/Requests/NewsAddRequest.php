<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsAddRequest extends FormRequest
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
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|min:10|max:255',
            'description' => 'required'
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
                'title' => __('validation.attributes.heading'),
                'description' => __('validation.attributes.article'),
                'category_id' => __('validation.attributes.category'),
                'author_id' => __('validation.attributes.author')
            ];
    }
}
