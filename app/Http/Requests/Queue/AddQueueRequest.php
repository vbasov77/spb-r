<?php

declare(strict_types=1);

namespace App\Http\Requests\Queue;

use Illuminate\Foundation\Http\FormRequest;

class AddQueueRequest extends FormRequest
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
            "date_book" => ['required', 'string'],
            "name" => ['required', 'string', 'min:2', 'max:200'],
            "phone" => ['required', 'string', 'min:17', 'max:17']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'date_book' => "Выберете дату",
            'name' => "Имя",
            'phone' => "Телефон"
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
