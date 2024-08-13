<?php

namespace App\Models;

use App\Models\Language as ModelsLanguage;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class Practitioner extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public const PROFILE_TYPE = [
        'staff' => '1',
        'therapist' => '2',
        'provider' => '3',
        'user' => '4',
        'admin' => '5',
    ];

    protected $hidden = [
        'creator_id',
        'pivot',
        'professional_suffix',
    ];
    
    protected $guarded = [];


    protected static function booted(): void {
        static::addGlobalScope('creator', function(Builder $builder) {
            $builder->where('creator_id', Auth::id());
        });
    }

    public function accepted_visits(): HasOne {
        return $this->hasOne(AcceptedVisit::class, 'parent_id');
    }
    
    public function educations(): HasMany {
        return $this->hasMany(PractitionerEducation::class, 'parent_id');
    }

    public function assistant(): HasOne {
        return $this->hasOne(AdministrativeContact::class, 'parent_id');
    }

    public function gender(): BelongsTo {
        return $this->belongsTo(GenderType::class, 'gender', 'id');
    }
    
    public function specialties(): HasMany {
        return $this->hasMany(PractitionerSpecialty::class, 'parent_id')->with('specialty');
    }

    public function suffixes(): HasMany {
        return $this->hasMany(PractitionerProffesionalSuffix::class, 'parent_id')->with('suffix');
    }

    public function profile_type(): BelongsTo {
        return $this->belongsTo(ProfileType::class, 'profile_type', 'id');
    }

    public function faith() : HasOne {
        return $this->hasOne(Faith::class, 'id');
    }


    public function visit_reasons() {
        return $this->belongsToMany(VisitReason::class, 'practitioner_visit_reason', 'parent_id')
        ->withTimestamps()
        ->as('visit_reasons');
    }

    public function focus_areas() {
        return $this->belongsToMany(FocusArea::class, 'practitioner_focus_area', 'parent_id')
        ->withTimestamps()
        ->as('focus_areas');
    }

    public function treatment_approaches() {
        return $this->belongsToMany(TreatmentApproach::class, 'practitioner_treatment_approach', 'parent_id')
        ->withTimestamps()
        ->as('treatment_approaches');
    }

    public function modalities() {
        return $this->belongsToMany(Modality::class, 'practitioner_modality', 'parent_id')
        ->withTimestamps()
        ->as('modalities');
    }

    public function age_ranges() {
        return $this->belongsToMany(AgeRange::class, 'practitioner_age_range', 'parent_id')
        ->withTimestamps()
        ->as('age_ranges');
    }

    public function ethnicities() {
        return $this->belongsToMany(Ethnicity::class, 'practitioner_ethnicities', 'parent_id')
        ->withTimestamps()
        ->as('ethnicities');
    }

    public function languages() {
        return $this->belongsToMany(ModelsLanguage::class, 'practitioner_languages', 'parent_id')
        ->withTimestamps()
        ->as('languages_pivot');
    }

    public function abouts() {
        return $this->hasOne(About::class, 'parent_id');
    }

    public function license_types() {
        return $this->belongsToMany(LicenseType::class, 'license_details', 'parent_id')
        ->withTimestamps()
        ->as('license_types_pivot');
    }

    public function boards() {
        return $this->hasMany(BoardCertification::class, 'parent_id');
    }

    public function affiliations() {
        return $this->hasMany(PractitionerHospitalAffiliation::class, 'parent_id');
    }

    public function awards() {
        return $this->hasMany(AwardsPublication::class, 'parent_id');
    }


    // public function gender(): HasOne {
    //     return $this->hasOne(GenderType::class, 'id');
    // }

    // public function patients(): BelongsToMany {
    //     return $this->belongsToMany(Patient::class, 'patient_practitioner_schedule')->withTimestamps();
    // }

    // public function schedules(): BelongsToMany {
    //     return $this->belongsToMany(PractitionerSchedule::class, 'patient_practitioner_schedule')->withTimestamps();
    // }
}