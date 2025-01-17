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
            "password" => ['required', 'integer']
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
            'integer' => "Поле :attribute должно быть цыфрой",
            'min:4' =>  "Поле :attribute не должно быть меньше 4-х символов",
            'max:4' => "Поле :attribute не должно быть больше 4-х символов"
        ];
    }
}
