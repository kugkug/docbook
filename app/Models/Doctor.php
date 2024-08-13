<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    protected $fillable = [
        'title', 'firstname', 'lastname', 'practice_name', 
        'provider_specialty', 'contact_number', 'email', 
        'street', 'unit_number', 'city', 'state', 
        'state_abbr', 'country', 'zip_code', 'latitude', 
        'longitude', 'visit_type', 'insurance_carrier', 'insurance_plan'
    ];

    public const rules = [
        "title" => "required|string|max:255",
        "firstname" => "required|string|max:255",
        "lastname" => "required|string|max:255",
        "practice_name" => "string|max:255",
        "provider_specialty" => "string|max:255",
        "contact_number" => "string|max:255",
        "email" => "sometimes|required|string|max:255",
        "street" => "string|max:255",
        "unit_number" => "string|max:255",
        "city" => "string|max:255",
        "state" => "string|max:255",
        "state_abbr" => "string|max:255",
        "country" => "string|max:255",
        "zip_code" => "string|max:255",
        "latitude," => "string|max:255",
        "longitude," => "string|max:255",
        "visit_type," => "string|max:255",
        "insurance_carrier," => "string|max:255",
        "insurance_plan" => "string|max:255",
    ];
}
