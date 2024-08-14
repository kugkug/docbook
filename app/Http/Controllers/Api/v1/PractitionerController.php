<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\GlobalHelper;
use App\Helpers\PractitionerHelper;
use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\Practitioner;
use App\Http\Requests\StorePractitionerRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdatePractitionerRequest;
use App\Http\Resources\PractitionerResource;
use App\Http\Resources\ProviderResource;
use App\Models\About;
use App\Models\AcceptedVisit;
use App\Models\AdministrativeContact;
use App\Models\AwardsPublication;
use App\Models\BoardCertification;
use App\Models\ClinicAddress;
use App\Models\Ethnicity;
use App\Models\Gender;
use App\Models\LicenseDetail;
use App\Models\PractitionerEducation;
use App\Models\PractitionerEthnicity;
use App\Models\PractitionerFaith;
use App\Models\PractitionerHospitalAffiliation;
use App\Models\PractitionerLanguage;
use App\Models\PractitionerMembership;
use App\Models\PractitionerProffesionalSuffix;
use App\Models\PractitionerResidentialAddress;
use App\Models\PractitionerSpecialty;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Validator;

class PractitionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = Practitioner::orderBy('last_name', 'ASC')->paginate(10);
        return GlobalHelper::response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = GlobalHelper::validate($request->all(), RulesHelper::StorePractitionerRules());
            
            if ( !$validated ) {
                return GlobalHelper::errorResponse([
                    'status' => 'error', 
                    'message' => 'Invalid Data Structure'
                ], 422);
            }

            $data = PractitionerHelper::setPractitionerData($validated['data']);

            //User
            $user = User::create($data['user_data']);
            $user_id = $user->id;
            //Practitioner Data
            $data['practitioner_data']['creator_id'] = Auth::id();

            $practitioner = Practitioner::create($data['practitioner_data']);
            $practitioner_id = $practitioner->id;


            //Clini Addresses
            $clinic_address = array_merge($data['clinic_address'], ['parent_id'  => $practitioner_id]);
            ClinicAddress::create($clinic_address);

            //Accepted visits
            $accepted_visit_data = array_merge($data['accepted_visit_data'], ['parent_id' => $practitioner_id]);
            AcceptedVisit::create($accepted_visit_data);

            //Specialty Data
            $specialty_data = array_map(function($specialty) use($practitioner_id) {
                return  array_merge($specialty, ['parent_id'  => $practitioner_id]);
            }, $data['specialty_data']);
            
            PractitionerSpecialty::insert($specialty_data);

            $suffixes_data = array_map(function($suffixe) use($practitioner_id) {
                return  array_merge($suffixe, ['parent_id'  => $practitioner_id]);
            }, $data['professional_suffixes']);

            PractitionerProffesionalSuffix::insert($suffixes_data);
            
            //Education data
            $education_data = array_map(function($education) use ($practitioner_id) {
                return array_merge($education, ['parent_id' => $practitioner_id]);
            },$data['education_data']);
            PractitionerEducation::insert($education_data);
            
            //Administrative data
            $administrative_data = array_merge($data['administrative_data'], ['parent_id' => $practitioner_id]);
            AdministrativeContact::create($administrative_data);

            GlobalHelper::send_email("new_password", $data['email'], ['password' => $data['decrypted']]);
            
            DB::commit();
            
            return GlobalHelper::response([
                'message' => 'saved',
                'password' => $data['decrypted'],
            ], 200);
            
        } catch(\Exception $e) {
            DB::rollBack();
            return GlobalHelper::response([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $data = PractitionerHelper::getPractitionerData($id);
        if (isset($data['status']) && $data['status'] == "error") {
            return GlobalHelper::errorResponse($data, 404);
        } else {
            return GlobalHelper::response($data, 200);
        }
        
    }

    public function update(Request $request, $practitioner_id)
    {
        DB::beginTransaction();
        try {
            $validated = GlobalHelper::validate($request->all(), RulesHelper::UpdatePractitionerRules());

            if ( !$validated ) {
                return GlobalHelper::errorResponse([
                    'status' => 'error', 
                    'message' => 'Invalid Data Structure'
                ], 422);
            }

            $data = PractitionerHelper::setPractitionerUpdateData($practitioner_id, $validated['data']);
            $practitioner_info = Practitioner::where('id', $practitioner_id)->get();

            if ( $practitioner_info->isEmpty()) {
                return GlobalHelper::errorResponse([
                    'status' => 'error', 
                    'message' => 'Practitioner not found'
                ], 404);
            }

            $practitioner = $practitioner_info->first();
            $user_id = $practitioner['creator_id'];           

            //use to update 
            $practitioner = Practitioner::find($practitioner_id);

            //Practitioner Data
            if (isset($data['practitioner_data'])) {
                $practitioner->update($data['practitioner_data']);
            }

            if (isset($data['about'])) {
                $about = About::where('parent_id', $practitioner_id)->get();
                if ($about->isEmpty()) {
                    About::create($data['about']);
                } else {
                    About::where('parent_id', $practitioner_id)->update($data['about']);
                }
            }

            //User Data
            if (isset($data['user_data'])) {
                $user = User::find($user_id);
                $user->update($data['user_data']);
            }

            //clini Addresses
            if (isset($data['addresses_data'])) {
                ClinicAddress::where('parent_id', $practitioner_id)->delete();
                ClinicAddress::create($data['addresses_data']);   
            }

            //Specialty Data
            if (isset($data['specialty_data'])) {
                PractitionerSpecialty::where('parent_id', $practitioner_id)->delete();
                PractitionerSpecialty::insert($data['specialty_data']);
            }

            if (isset($data['professional_suffixes'])) {
                $suffixes = PractitionerProffesionalSuffix::where('parent_id', $practitioner_id)->delete();
                PractitionerProffesionalSuffix::insert($data['professional_suffixes']);
            }

            if (isset($data['ethnicity'])) {
                $practitioner->ethnicities()->sync($data['ethnicity']);
            }

            if (isset($data['language'])) {                
                $practitioner->languages()->sync($data['language']);
            }

            if (isset($data['education_data'])) {
                $education_data = PractitionerEducation::where('parent_id', $practitioner_id)->delete();
                PractitionerEducation::insert($data['education_data']);
            }


            if (isset($data['professional_memberships'])) {
                $memberships = PractitionerMembership::where('parent_id', $practitioner_id)->delete();
                PractitionerMembership::insert($data['professional_memberships']);
            }


            if (isset($data['hospital_affiliations'])) {

                $hospital_affiliations = PractitionerHospitalAffiliation::where('parent_id', $practitioner_id)->delete();
                
                PractitionerHospitalAffiliation::insert($data['hospital_affiliations']);
            }

            if (isset($data['board_certifications'])) {
                $board_certifications = BoardCertification::where('parent_id', $practitioner_id)->delete();
                BoardCertification::insert($data['board_certifications']);
            }


            if (isset($data['awards_publications'])) {
                $awards_publication = AwardsPublication::where('parent_id', $practitioner_id)->delete();
                AwardsPublication::insert($data['awards_publications']);
            }

            if (isset($data['license_details'])) {
                $practitioner->license_types()->sync($data['license_details']);
            }


            if (isset($data['visit_reasons'])) {
                $practitioner->visit_reasons()->sync($data['visit_reasons']);
            }

            if (isset($data['focus_areas'])) {
                $practitioner->focus_areas()->sync($data['focus_areas']);
            }

            if (isset($data['treatment_approaches'])) {
                $practitioner->treatment_approaches()->sync($data['treatment_approaches']);
            }

            if (isset($data['modalities'])) {
                $practitioner->modalities()->sync($data['modalities']);
            }

            if (isset($data['age_ranges'])) {
                $practitioner->age_ranges()->sync($data['age_ranges']);
            }
            // GlobalHelper::send_email("new_password", $data['email'], ['password' => $data['decrypted']]);
            
            DB::commit();
            
            return GlobalHelper::response([
                'status' => 'success',
                'message' => 'Successfully Updated!'
            ], 200);
            
        } catch(\Exception $e) {
            DB::rollBack();
            return GlobalHelper::response([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function update_clientele(Request $request, $practitioner_id)
    {
        DB::beginTransaction();
        try {

            $validated = GlobalHelper::validate($request->all(), RulesHelper::UpdatePractitionerRules());

            if ( !$validated ) {
                return GlobalHelper::errorResponse([
                    'status' => 'error', 
                    'message' => 'Invalid Data Structure'
                ], 422);
            }

            $practitioner = Practitioner::find($practitioner_id);
            $clientele_data = $validated['data'];
            if (isset($clientele_data['visit_reasons'])) {
                $practitioner->visit_reasons()->sync($clientele_data['visit_reasons']);
            }

            if (isset($clientele_data['focus_areas'])) {
                $practitioner->focus_areas()->sync($clientele_data['focus_areas']);
            }

            if (isset($clientele_data['treatment_approaches'])) {
                $practitioner->treatment_approaches()->sync($clientele_data['treatment_approaches']);
            }

            if (isset($clientele_data['modalities'])) {
                $practitioner->modalities()->sync($clientele_data['modalities']);
            }

            if (isset($clientele_data['age_ranges'])) {
                $practitioner->age_ranges()->sync($clientele_data['age_ranges']);
            }
            
            DB::commit();
            
            return GlobalHelper::response([
                'status' => 'success',
                'message' => 'Successfully Updated!'
            ], 200);
            
        } catch(\Exception $e) {
            DB::rollBack();
            return GlobalHelper::response([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
    
    public function destroy(Practitioner $practitioner)
    {
        //
    }
}