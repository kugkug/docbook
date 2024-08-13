<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot',
    ];

    protected $fillable = [
        'title', 'firstname', 'lastname', 'gender', 
        'contact_number', 'email', 'street', 'creator_id',
        'unit_number', 'city', 'state', 'state_abbr', 
        'country', 'latitude', 'longitude', 'zip_code'
    ];

    // public const rules = [
    //     'title' => "",
    //     'firstname' => "required|string|max:255",
    //     'lastname' => "required|string|max:255",
    //     'gender' => "required|string|max:255",
    //     'contact_number' => "string|max:255",
    //     'email' => "sometimes|required|string|max:255",
    //     'street' => "string|max:255",
    //     'unit_number' => "string|max:255",
    //     'city' => "string|max:255",
    //     'state' => "string|max:255",
    //     'state_abbr' => "string|max:255",
    //     'country' => "string|max:255",
    //     'latitude' => "string|max:255",
    //     'longitude' => "string|max:255",
    //     'zip_code' => "string|max:255"
    // ];

    public function practitioners(): BelongsToMany {
        return $this->belongsToMany(Practitioner::class, 'patient_practitioner_schedule')->withTimestamps();
    }

    public function practitioner_schedules(): BelongsToMany {
        return $this->belongsToMany(PractitionerSchedule::class, 'patient_practitioner_schedule')->withTimestamps();
    }
}