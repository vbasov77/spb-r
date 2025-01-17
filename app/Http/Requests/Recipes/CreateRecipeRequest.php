<?php

namespace App\Http\Requests\Recipes;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecipeRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'text' => ['nullable', 'array', 'min:3', 'max:500'],
            'img' => ['nullable', 'array'],
            'img.*' => ['mimes:png', 'max:25600']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'title' => "Название",
            'description' => "Описание",
            'text' => "Текст",
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => "Поле :attribute обязательно для заполнения",
            'string' => "Поле :attribute должно быть строкой",
        ];
    }
}
