<?php

declare(strict_types=1);

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class EditOrderRequest extends FormRequest
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
            "name" => ['required', 'string', 'min:2', 'max:200'],
            "email" => ['required', 'string', 'email:rfc,dns'],
            "phone" => ['required', 'string', 'min:17', 'max:17'],
            "total" => ['required', 'integer']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => "ФИО",
            'phone' => "Телефон",
            'email' => "Email",
            'total' => "Сумма"
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
