<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\PractitionerHospitalAffiliation;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class PractitionerHospitalAffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(PractitionerHospitalAffiliation::class)
        ->where('creator_id', Auth::id())
        ->paginate();
            
        return $data;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(RulesHelper::practitioner_hospital_affiliation_store_rules());
            $practitioner_hospital_affiliations = Auth::user()->practitioner_hospital_affiliations()->create($validated);

            if ($practitioner_hospital_affiliations) {
                return GlobalHelper::response($practitioner_hospital_affiliations);
            } else {
                return GlobalHelper::response(['error']);
            }
            
        } catch (ValidationException $ve) {
            
            return GlobalHelper::errorResponse([
                'status' => 'error',
                'message' => $ve->validator->errors(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return GlobalHelper::response(PractitionerHospitalAffiliation::where('id', $id)->first());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PractitionerHospitalAffiliation $practitioner_hospital_affiliations, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::practitioner_hospital_affiliation_store_rules());
            $practitioner_hospital_affiliation = $practitioner_hospital_affiliations->find($id);
            
            if ($practitioner_hospital_affiliation->update($validated)) {
                return GlobalHelper::response($practitioner_hospital_affiliation);
            } else {
                return GlobalHelper::errorResponse([
                    'status' => 'error',
                    'message' => 'Failed to update data',
                ], 400);
            }
        } catch (ValidationException $ve) {
            return GlobalHelper::errorResponse([
                'status' => 'error',
                'message' => $ve->validator->errors(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PractitionerHospitalAffiliation $practitionerHospitalAffiliation)
    {
        //
    }
}
