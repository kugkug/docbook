<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => 'required|max:255',
            "last_name" => 'required|max:255',
            "zip_code" => 'required|max:255',
            'email' => 'required|max:255|email|unique:practitioners,email',
            "phone" => 'required|max:255',
            "sex" => 'sometimes|max:255',
        ];
    }
}