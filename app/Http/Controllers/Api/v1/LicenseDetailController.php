<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\LicenseDetail;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class LicenseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(LicenseDetail::class)
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
            $validated = $request->validate(RulesHelper::license_detail_store_rules());
            $license_detail = Auth::user()->license_details()->create($validated);

            if ($license_detail) {
                return GlobalHelper::response($license_detail);
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
        return GlobalHelper::response(LicenseDetail::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LicenseDetail $license_details, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::license_detail_store_rules());
            $license_detail = $license_details->find($id);
            
            if ($license_detail->update($validated)) {
                return GlobalHelper::response($license_detail);
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
    public function destroy(LicenseDetail $licenseDetail)
    {
        //
    }
}
