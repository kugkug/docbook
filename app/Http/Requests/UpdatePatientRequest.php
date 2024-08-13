<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'title' => "string|max:255",
            'firstname' => "string|max:255",
            'lastname' => "string|max:255",
            'gender' => "string|max:255",
            'email' => "string|max:255",
            "contact_number" => "string|max:255",
            "zip_code" => "string|max:255"
        ];
    }
}
