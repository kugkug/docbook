<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\PractitionerResidentialAddress;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class PractitionerResidentialAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(PractitionerResidentialAddress::class)
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
            $validated = $request->validate(RulesHelper::practitioner_residential_address_store_rules());
            $practitioner_residentials_address = Auth::user()->practitioner_residentials_addresses()->create($validated);

            if ($practitioner_residentials_address) {
                return GlobalHelper::response($practitioner_residentials_address);
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
        return GlobalHelper::response(PractitionerResidentialAddress::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PractitionerResidentialAddress $practitioner_residentials_addresses, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::practitioner_residential_address_store_rules());
            $practitioner_residentials_address = $practitioner_residentials_addresses->find($id);
            
            if ($practitioner_residentials_address->update($validated)) {
                return GlobalHelper::response($practitioner_residentials_address);
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
    public function destroy(PractitionerResidentialAddress $practitionerResidentialAddress)
    {
        //
    }
}
