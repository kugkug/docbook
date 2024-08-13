<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\PractitionerSpecialty;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class PractitionerSpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(PractitionerSpecialty::class)
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
            $validated = $request->validate(RulesHelper::practitioner_specialty_store_rules());
            $practitioner_specialty = Auth::user()->practitioner_specialties()->create($validated);

            if ($practitioner_specialty) {
                return GlobalHelper::response($practitioner_specialty);
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
        return GlobalHelper::response(PractitionerSpecialty::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PractitionerSpecialty $practitioner_specialties, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::practitioner_specialty_store_rules());
            $practitioner_specialty = $practitioner_specialties->find($id);
            
            if ($practitioner_specialty->update($validated)) {
                return GlobalHelper::response($practitioner_specialty);
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
    public function destroy(PractitionerSpecialty $practitionerSpecialty)
    {
        //
    }
}
