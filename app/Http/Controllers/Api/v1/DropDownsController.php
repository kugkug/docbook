<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AgeRange;
use App\Models\Ethnicity;
use App\Models\Faith;
use App\Models\FocusArea;
use App\Models\GenderType;
use App\Models\Language;
use App\Models\LicenseType;
use App\Models\Modality;
use App\Models\ProfessionalSuffix;
use App\Models\ProfileType;
use App\Models\SpecialtyType;
use App\Models\TreatmentApproach;
use App\Models\VisitReason;
use Illuminate\Http\Request;

class DropDownsController extends Controller
{
    //Ethicities

    //Gender Types
    public function gender_types() {
        $genders = GenderType::all();
        return $genders;
    }

    //License Details

    public function license_types() {
        $licenses = LicenseType::all();
        return $licenses;
    }

    //Profile Types
    public function profile_types() {
        $profiles = ProfileType::all();
        return $profiles;
    }

    //Specialty Types

    public function specialty_types() {
        $specialties = SpecialtyType::all();
        return $specialties;
    }

    //Ethnicities
    public function ethnicities() {
        $ethnicities = Ethnicity::all();
        return $ethnicities;
    }

    //Religions
    public function faiths() {
        $faiths = Faith::all();
        return $faiths;
    }

    //Visit Reasons
    public function visit_reasons() {
        $reasons = VisitReason::all();
        return $reasons;
    }

    public function suffixes() {
        $suffixes = ProfessionalSuffix::all();
        return $suffixes;
    }

    public function focus_areas() {
        $focus_areas = FocusArea::all();
        return $focus_areas;
    }

    public function modalities() {
        $modalities = Modality::all();
        return $modalities;
    }

    public function age_ranges() {
        $age_ranges = AgeRange::all();
        return $age_ranges;
    }

    public function treatment_approaches() {
        $treatment_approaches = TreatmentApproach::all();
        return $treatment_approaches;
    }

    public function languages() {
        $languages = Language::all();
        return $languages;
    }

}