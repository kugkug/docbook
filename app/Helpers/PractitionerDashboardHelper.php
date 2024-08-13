<?php

namespace App\Helpers;

use App\Models\AcceptedVisit;
use App\Models\AwardsPublication;
use App\Models\BoardCertification;
use App\Models\ClinicAddress;
use App\Models\LicenseDetail;
use App\Models\PractitionerEducation;
use App\Models\PractitionerEthnicity;
use App\Models\PractitionerHospitalAffiliation;
use App\Models\PractitionerResidentialAddress;
use App\Models\PractitionerSchedule;
use App\Models\PractitionerSpecialty;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PractitionerDashboardHelper {

    //accepted visits
    public static function accepted_visit($practitioner_id) {
        return AcceptedVisit::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //award publications
    public static function award_publications($practitioner_id) {
        return AwardsPublication::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //board_certifications
    public static function board_certifications($practitioner_id) {
        return BoardCertification::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //clinic_address
    public static function clinic_address($practitioner_id) {
        return ClinicAddress::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //license_details
    public static function license_details($practitioner_id) {
        return LicenseDetail::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //practitioner_educaton
    public static function practitioner_educaton($practitioner_id) {
        return PractitionerEducation::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //ethnicities
    public static function ethnicities($practitioner_id) {
        return PractitionerEthnicity::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //hospital_affiliations
    public static function hospital_affiliations($practitioner_id) {
        return PractitionerHospitalAffiliation::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //residential_address
    public static function residential_address($practitioner_id) {
        return PractitionerResidentialAddress::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //specialties
    public static function specialties($practitioner_id) {
        return PractitionerSpecialty::where('creator_id', $practitioner_id)->get()->toArray();
    }

    //schedules
    public static function schedules($practitioner_id) {
        return PractitionerSchedule::where('creator_id', $practitioner_id)->get()->toArray();
    }


}