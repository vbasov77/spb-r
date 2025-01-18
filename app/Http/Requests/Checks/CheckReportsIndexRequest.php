<?php

namespace App\Http\Requests\Checks;

use Illuminate\Foundation\Http\FormRequest;

class CheckReportsIndexRequest extends FormRequest
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
            "password" => ['required', 'string']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'password' => "Пароль",
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
