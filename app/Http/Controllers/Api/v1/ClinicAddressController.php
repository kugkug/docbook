<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\ClinicAddress;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class ClinicAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(ClinicAddress::class)
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
            $validated = $request->validate(RulesHelper::clinic_address_store_rules());
            $clinic_addresses = Auth::user()->clinic_addresses()->create($validated);

            if ($clinic_addresses) {
                return GlobalHelper::response($clinic_addresses);
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
        return GlobalHelper::response(ClinicAddress::where('id', $id)->first());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClinicAddress $clinic_addresses, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::clinic_address_store_rules());
            $clinic_address = $clinic_addresses->find($id);
            
            if ($clinic_address->update($validated)) {
                return GlobalHelper::response($clinic_address);
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
    public function destroy(ClinicAddress $clinicAddress)
    {
        //
    }
}
