<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\PractitionerEthnicity;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\Global_;
use Spatie\QueryBuilder\QueryBuilder;

class PractitionerEthnicityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(PractitionerEthnicity::class)
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
            $validated = $request->validate(RulesHelper::practitioner_ethnicity_store_rules());
            $practitioner_ethnicity = Auth::user()->practitioner_ethnicities()->create($validated);

            if ($practitioner_ethnicity) {
                return GlobalHelper::response($practitioner_ethnicity);
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
        return GlobalHelper::response(PractitionerEthnicity::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PractitionerEthnicity $practitioner_ethnicities, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::practitioner_ethnicity_store_rules());
            $practitioner_ethnicity = $practitioner_ethnicities->find($id);
            
            if ($practitioner_ethnicity->update($validated)) {
                return GlobalHelper::response($practitioner_ethnicity);
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
    public function destroy(PractitionerEthnicity $practitionerEthnicity)
    {
        //
    }
}
