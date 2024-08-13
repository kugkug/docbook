<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'title' => "required|string|max:255",
            'firstname' => "required|string|max:255",
            'lastname' => "required|string|max:255",
            'email' => "sometimes|required|string|max:255",
            "practice_name" => "string|max:255",
            "provider_specialty" => "string|json|max:255",
            "contact_number" => "string|max:255",
            "zip_code" => "string|max:255",
            "gender_info" => "string|json|max:255",
        ];
    }
}
