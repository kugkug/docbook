<?php

namespace App\Helpers;

use App\Models\AcceptedVisit;
use App\Models\AdministrativeContact;
use App\Models\Gender;
use App\Models\Practitioner;
use App\Models\PractitionerEducation;
use App\Models\PractitionerSpecialty;
use Carbon\Carbon;

class PractitionerHelper {

    public static function setPractitionerData($request) {
        $return = [];
        $timestamp = Carbon::now()->format("Y-m-d H:i:s");
        $default_password = GlobalHelper::encrypt(GlobalHelper::generateDefaultPassword());
        $decrypted = GlobalHelper::decrypt($default_password);
        
        $return['decrypted'] = $decrypted;
        $return['email'] = $request['provider_email'];
        //User Data
        $return['user_data'] = [
            'name' => $request['provider_first_name'].' '.$request['provider_last_name'],
            'email' => $request['provider_email'],
            'user_type' => $request['profile_type'],
            'password' => $default_password,
            'created_at' => $timestamp,
        ];

        //Practitioner Data
        $return['clinic_address'] = [
            'address_one' => $request['address_one'],
            'address_two' => $request['address_two'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip_code' => $request['zip_code'],
            'created_at' => $timestamp,
        ];

        $return['practitioner_data'] = [
            'first_name' => $request['provider_first_name'],
            'last_name' => $request['provider_last_name'],
            'npi_number' => isset($request['npi_number']) ? $request['npi_number'] : '',
            'email' => $request['provider_email'],
            'phone' => $request['provider_phone'],
            'gender' => $request['provider_gender'],
            'ext' => isset($request['provider_ext']) ? $request['provider_ext'] : '',
            'fax' => isset($request['provider_fax']) ? $request['provider_fax'] : '',
            'profile_type' => $request['profile_type'],
            'created_at' => $timestamp,
        ];

        foreach ($request['professional_suffixes'] as $professional_suffixes) { 
            $return['professional_suffixes'][] = [
                'professional_suffix_id' => $professional_suffixes,
                'created_at' => $timestamp,
            ];
        }
        //Accepted Visits
        foreach ($request['accepted_visits'] as $visit)
            $return['accepted_visit_data'][$visit] = 1;
    
        $return['accepted_visit_data']['created_at'] = $timestamp;


        //Specialties
        foreach ($request['specialty'] as $specialty) { 
            $return['specialty_data'][] = [
                'specialty_type_id' => $specialty,
                'created_at' => $timestamp,
            ];
        }

        //Education
        foreach ($request['education'] as $education) { 
            $return['education_data'][] = [
                'institution_name' => $education['institution_name'],
                'degree_credential_etc' => $education['degree_credential_etc'],
                'created_at' => $timestamp,
            ];
        }
        
        //Administrative Data
        $return['administrative_data'] = [
            'first_name' => $request['administrative_last_name'],
            'last_name' => $request['administrative_last_name'],
            'job_title' => isset($request['administrative_job_title']) ? $request['administrative_job_title'] : '',
            'email' => isset($request['administrative_email']) ? $request['administrative_email'] : '',
            'phone' => isset($request['administrative_phone']) ? $request['administrative_phone'] : '',
            'created_at' => $timestamp,
        ];

        return $return;
    }

    public static function setPractitionerUpdateData($practitioner_id, $request) {
        // return $request;
        $return = [];
        $timestamp = Carbon::now()->format("Y-m-d H:i:s");
        
        //Practitioner Data
        if (isset($request['basic_information'])) {
            foreach($request['basic_information'] as $col_key => $col_value) {
                
                if (!in_array($col_key, [
                    'specialty', 
                    'address_one', 
                    'address_two', 
                    'city', 
                    'state', 
                    'zip_code', 
                    'professional_suffix'
                ])) {
                    $return['practitioner_data'][$col_key] = $col_value;
                }

                if (in_array($col_key, [
                    'address_one', 
                    'address_two', 
                    'city',
                    'state', 
                    'zip_code',
                ])) {
                    $return['addresses_data'][$col_key] = $col_value;
                    $return['addresses_data']['parent_id'] = $practitioner_id;
                    $return['addresses_data']['created_at'] = $timestamp;
                    $return['addresses_data']['updated_at'] = $timestamp;
                }

                if ($col_key === "email") {
                    $return['user_data'][$col_key] = $col_value;
                }

                if ($col_key === "specialty") {
                    foreach ($col_value as $specialty) { 
                        $return['specialty_data'][] = [
                            'parent_id' => $practitioner_id,
                            'specialty_type_id' => $specialty,
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    }
                }

                if ($col_key === "professional_suffix") {
                    foreach ($col_value as $suffix) { 
                        $return['professional_suffixes'][] = [
                            'parent_id' => $practitioner_id,
                            'professional_suffix_id' => $suffix,
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    }
                }
            }
        }
        
        if (isset($request['identity'])) {
            foreach($request['identity'] as $col_key => $col_value) {
                if ($col_key == "faith") {
                    $return['practitioner_data'][$col_key] = $col_value;
                } else {
                    foreach ($col_value as $value) {
                        $return[$col_key][] = [
                            'parent_id' => $practitioner_id,
                            $col_key.'_id' => $value,
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    }
                }
            }
        }
        if (isset($request['about']))  {
            $return['about'] = array_merge($request['about'], ['parent_id' => $practitioner_id]);
        }
        
        if (isset($request['education']))  {
            foreach($request['education'] as $education) {
                $return['education_data'][] = [
                    'parent_id' => $practitioner_id,
                    'institution_name' => $education['institution_name'],
                    'degree_credential_etc' => $education['degree_credential_etc'],
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }


        if (isset($request['hospital_affiliations']))  {
            foreach($request['hospital_affiliations'] as $hospital_affiliation) {
                $return['hospital_affiliations'][] = [
                    'parent_id' => $practitioner_id,
                    'hospital_name' => $hospital_affiliation,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }

        if (isset($request['board_certifications']))  {
            foreach($request['board_certifications'] as $board_certification) {
                $return['board_certifications'][] = [
                    'parent_id' => $practitioner_id,
                    'board_certification' => $board_certification,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }
        
        if (isset($request['awards_publications'])) {
            foreach($request['awards_publications'] as $award_publication) {
                $return['awards_publications'][] = [
                    'parent_id' => $practitioner_id,
                    'publication_or_award_name' => $award_publication,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }

        if (isset($request['professional_memberships']))  {
            foreach($request['professional_memberships'] as $professional_membership) {
                $return['professional_memberships'][] = [
                    'parent_id' => $practitioner_id,
                    'professional_membership' => $professional_membership,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }

        if (isset($request['licence_details'])) {
            foreach($request['licence_details'] as $col_key => $col_value) {
                $return['license_details'][] = [
                    'parent_id' => $practitioner_id,
                    "license_type_id" => $col_value['license_type_id'],
                    "license_number" => $col_value['license_number'],
                    "state" => $col_value['state'],
                    "expiration_date" => $col_value['expiration_date'],
                ];
            }
        } 
        
        if (isset($request['visit_reasons'])) {
            $return['visit_reasons'] = $request['visit_reasons'];
        }

        if (isset($request['focus_areas'])) {
            $return['focus_areas'] = $request['focus_areas'];
        }

        if (isset($request['treatment_approaches'])) {
            $return['treatment_approaches'] = $request['treatment_approaches'];
        }

        if (isset($request['modalities'])) {
            $return['modalities'] = $request['modalities'];
        }

        if (isset($request['age_ranges'])) {
            $return['age_ranges'] = $request['age_ranges'];
        }

        return $return;
    }

    public static function getPractitionerDatAll($user_id, $practitoner_id) {
        
        $data = Practitioner::all()
            ->with('accepted_visits')
            ->with('educations')
            ->with('assistant')
            ->get()->paginate(20);

        return $data;
    }

    

    public static function accepted_visit_data($practitioner_id) {
        return AcceptedVisit::where('parent_id', $practitioner_id)->get()->toArray()[0];
    }

    public static function practioner_data($practitioner_id) {
        $practitioner = Practitioner::where('id', $practitioner_id)->with('profile_type')->get()->toArray()[0];
        $practitioner['profile_type'] = $practitioner['profile_type']['type_label'];

        return $practitioner;
    }

    public static function gender_data($user_id) {
        $genders = Gender::where('parent_id', $user_id)->with('gender_type')->get()->toArray();
        return $genders;
    }

    public static function practitioner_specialties_data($practitioner_id) {
        $specialties = PractitionerSpecialty::where('parent_id', $practitioner_id)
        ->with('specialty')
        ->get()->toArray();
        return  $specialties;
    }

    public static function practitioner_educations_data($practitioner_id) {
        return PractitionerEducation::where('parent_id', $practitioner_id)->get()->toArray();
    }

    public static function administrative_contact_data($practitioner_id) {
        return AdministrativeContact::where('parent_id', $practitioner_id)->get()->toArray();
    }

    public static function getPractitionerData($practitioner_id) {
        $data = [];
        $data = Practitioner::where('id', $practitioner_id)
            ->with('clinic_address')
            ->with('gender')
            ->with('suffixes')
            ->with('faith')
            ->with('profile_type')
            ->with('accepted_visits')
            ->with('educations')
            ->with('languages')
            ->with('abouts')
            ->with('boards')
            ->with('affiliations')
            ->with('awards')
            ->with('assistant')
            ->with('license_types')
            ->with('specialties')
            ->with('visit_reasons')
            ->with('focus_areas')
            ->with('treatment_approaches')
            ->with('modalities')
            ->with('age_ranges')
            
            ->get()->toArray();

        if ($data) {
            return self::formatPractitionerData($data[0]);
        } else {
            
            return [
                'status' => 'error', 
                'message' => 'Practitioner not found'
            ];
        }
    }
    
    private static function formatPractitionerData($data) {
        $formatted_data = [];
        foreach($data as $key => $value) {
            if ($key === "suffixes") {
                foreach($value as $suffix) {
                    $formatted_data[$key][] = $suffix['suffix'][0]['suffix'];
                }
            } elseif ($key === "specialties") {
                foreach($value as $suffix) {
                    $formatted_data[$key][] = $suffix['specialty'][0];
                }
            } else {
                $formatted_data[$key] = $value;
            }
        }

        return $formatted_data;
    }
}