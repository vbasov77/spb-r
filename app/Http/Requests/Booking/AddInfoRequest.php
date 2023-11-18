<?php

declare(strict_types=1);

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class AddInfoRequest extends FormRequest
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
            "phone" => ["required", "string", "min:15"],
            "email" => ["required", "email:rfc,dns"],
        ];
    }

    public function attributes()
    {
        return [
            "phone" => "Телефон",
            "email" => "Email",
        ];
    }

    public function messages()
    {
        return [
            'required' => "Поле :attribute обязательно для заполнения",
            'string' => "Поле :attribute должно быть строкой",
        ];
    }
}
