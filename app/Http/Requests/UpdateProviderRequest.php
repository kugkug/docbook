<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProviderRequest extends FormRequest
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
            "profile_photo_url" => 'sometimes|max:255',
            "practitioner_signature_url" => 'sometimes|max:255',
            "first_name" => 'sometimes|max:255',
            "last_name" => 'sometimes|max:255',
            "npi_number" => 'max:255',
            'email' => 'sometimes|max:255|email|unique:users,email,'.Auth::id(),',id',
            "phone" => 'sometimes|max:255',
            "sex" => 'sometimes|max:255',
            "profile_type" => 'sometimes|max:255',
            "professional_suffix" => 'max:255',
            "practice_website" => 'max:255',
        ];
    }
}