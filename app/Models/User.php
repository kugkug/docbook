<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public const USER_TYPE = [
        'admin' => 5,
        'user' => 4,
        'provider' => 3,
        'therapist' => 2,
        'staff' => 1,
    ];
    

    //Genders
    public function genders(): HasMany {
        return $this->hasMany(Gender::class, 'creator_id');
    }

    // ->where('creator_id', Auth::id())
    public function accepted_visits(): HasOne {
        return $this->hasOne(AcceptedVisit::class, 'creator_id');
    }

    public function awards_publications(): HasMany {
        return $this->hasMany(AwardsPublication::class, 'creator_id');
    }

    public function board_certifications(): HasOne {
        return $this->hasOne(BoardCertification::class, 'creator_id');
    }

    public function clinic_addresses(): HasMany {
        return $this->hasMany(ClinicAddress::class, 'creator_id');
    }

    public function license_details(): HasMany {
        return $this->hasMany(LicenseDetail::class, 'creator_id');
    }

    public function practitioner_education(): HasMany {
        return $this->hasMany(PractitionerEducation::class, 'creator_id');
    }

    public function practitioner_ethnicities(): HasMany {
        return $this->hasMany(PractitionerEthnicity::class, 'creator_id');
    }

    public function practitioner_hospital_affiliations(): HasMany {
        return $this->hasMany(PractitionerHospitalAffiliation::class, 'creator_id');
    }

    public function practitioner_residentials_addresses(): HasMany {
        return $this->hasMany(PractitionerResidentialAddress::class, 'creator_id');
    }

    public function practitioner_specialties(): HasMany {
        return $this->hasMany(PractitionerSpecialty::class, 'creator_id');
    }

    public function practitioner_schedules(): HasMany {
        return $this->hasMany(PractitionerSchedule::class, 'creator_id');
    }

    public function doctor_schedules(): HasMany {
        return $this->hasMany(DoctorSchedule::class, 'creator_id');
    }

    public function schedules() {
        return $this->hasMany(PractitionerSchedule::class, 'creator_id');
    }


    // public function tokenExpired() {
    //     if (Carbon::parse($this->attributes['expires_at']) < Carbon::now()) {
    //         return true;
    //     }
    //     return false;
    // }

    

}