<?php
    namespace App\Helpers;

    class RulesHelper {

        public static function accepted_visit_store_rules() {
            return [
                'video_visit' => 'sometimes|integer',
                'in_person_visit' => 'sometimes|integer',
            ];
        }

        public static function awards_publication_store_rules() {
            return ['publication_or_award_name' => 'required|max:255'];
        }

        public static function board_certification_store_rules() {
            return ['board_certification' => 'required|max:255'];
        }

        public static function clinic_address_store_rules() {
            return [
                'address_one' => 'required|max:255',
                'address_two' => 'required|max:255',
                'city' => 'required|max:255',
                'state' => 'required|max:255',
                'zip_code' => 'required|max:255',
            ];
        }

        public static function ethnicity_store_rules() {
            return ['ethnicity_name' => 'required|max:255'];
        }

        public static function license_detail_store_rules() {
            return [
                'license_type_id' => 'required|integer',
                'license_number' => 'required|max:255',
                'state' => 'required|max:255',
                'expiration_date' => 'required|date',
            ];
        }

        public static function license_type_store_rules() {
            return [
                'license_name' => 'required|max:255',
                'license_abbreviation' => 'required|max:255',
            ];
        }

        public static function practitioner_education_store_rules() {
            return [
                'institution_name' => 'required|max:255',
                'degree_credential_etc' => 'required|max:255',
                'date_acquired' => 'sometimes|max:255',
            ];
        }

        public static function practitioner_ethnicity_store_rules() {
            return ['ethnicity_id' => 'required|integer'];
        }

        public static function practitioner_hospital_affiliation_store_rules() {
            return ['hospital_name' => 'required|max:255'];
        }

        public static function practitioner_residential_address_store_rules() {
            return [
                'address_one' => 'required|max:255',
                'address_two' => 'required|max:255',
                'city' => 'required|max:255',
                'state' => 'required|max:255',
                'zip_code' => 'required|max:255',
            ];
        }

        public static function practitioner_specialty_store_rules() {
            return ['specialty_type_id' => 'required|integer'];
        }

        public static function provider_store_rules() {
            return [
                'name' => 'required|max:255',
                'logo_url' => 'required|max:255',
            ];
        }

        public static function provider_administrator_store_rules() {
            return [
                'profile_photo_url' => 'required|max:255',
                'first_name' => 'required|max:255',
                'last_namee' => 'required|max:255',
                'email' => 'required|max:255',
                'phone' => 'required|max:255',
            ];
        }

        public static function specialty_type_store_rules() {
            return ['specialty_name' => 'required|max:255'];
        }

        public static function practitioner_schedules_store_rules() {
            return [
                'date' => 'required|max:255',
                'day' => 'required|max:255',
                'start_time' => 'required|max:255',
                'end_time' => 'required|max:255',
                'location' => 'required|max:255'
            ];
        }

        //Patients /Clients

        public static function patient_store_rules() {
            return [
                'title' => "sometimes|string|max:255",
                'firstname' => "required|string|max:255",
                'lastname' => "required|string|max:255",
                'gender' => "required|string|max:255",
                'contact_number' => "string|max:255",
                'email' => "sometimes|required|string|max:255",
            ];
        }



        public static function StorePractitionerRules() {
            return [
                "accepted_visits" => "required",
                "address_one" => "required|max:255",
                "address_two" => "required|max:255",
                "city" => "required|max:255",
                "state" => "required|max:255",
                "zip_code" => "required|max:255",
                "provider_email" => "required|max:255|email|unique:practitioners,email",
                "provider_phone" => "required|max:255",
                "provider_first_name" => "required|max:255",
                "provider_last_name" => "required|max:255",
                "provider_gender" => "required",
                "specialty" => "required|array|min:1",
                "professional_suffixes" => "required|array|min:1",
                "profile_type" => "required",
                "education" => "required|array|min:1",
                "adminstrative_first_name" => "required|max:255",
                "administrative_last_name" => "required|max:255",
            ];
        }

        public static function UpdatePractitionerRules() {
            return [
                "basic_information" => "sometimes|array|min:1",
                "identity" => "sometimes|array|min:1",
                "about" => "sometimes|array|min:1",
                "education" => "sometimes|array|min:1",
                "residencies" => "sometimes|array|min:1",
                "hospital_affiliations" => "sometimes|array|min:1",
                "board_certifications" => "sometimes|array|min:1",
                "professional_memberships" => "sometimes|array|min:1",
                "awards_publications" => "sometimes|array|min:1",
                "licence_details" => "sometimes|array|min:1",
                "visit_reasons" => "sometimes|array|min:1",
                "focus_areas" => "sometimes|array|min:1",
                "treatment_approaches" => "sometimes|array|min:1",
                "modalities" => "sometimes|array|min:1",
                "age_ranges" => "sometimes|array|min:1",
            ];
        }
    }