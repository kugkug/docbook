<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StorePractitionerRequest extends FormRequest
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
        try {
            return [
                "accepted_visits" => "required",
                "address_one" => "required|max:255",
                "address_two" => "required|max:255",
                "city" => "required|max:255",
                "provider_email" => "required|max:255|email|unique:practitioners,email",
                "provider_phone" => "required|max:255",
                "provider_first_name" => "required|max:255",
                "provider_last_name" => "required|max:255",
                "provider_gender" => "required",
                "specialty" => "required|array|min:1",
                "profile_type" => "required",
                "education" => "required|array|min:1",
                "adminstrative_first_name" => "required|max:255",
                "administrative_last_name" => "required|max:255",
            ];
        } catch(ValidationException $ve) {
            dd($ve->getMessage());
        }
    }
}