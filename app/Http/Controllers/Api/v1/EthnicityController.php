<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\Ethnicity;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class EthnicityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(Ethnicity::class)
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
            $validated = $request->validate(RulesHelper::ethnicity_store_rules());
            $license_type = Ethnicity::create($validated);

            if ($license_type) {
                return GlobalHelper::response($license_type);
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
        return GlobalHelper::response(Ethnicity::where('id', $id)->first());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ethnicity $ethnicities, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::ethnicity_store_rules());
            $ethnicity = $ethnicities->find($id);
            
            if ($ethnicity->update($validated)) {
                return GlobalHelper::response($ethnicity);
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
    public function destroy(Ethnicity $ethnicity)
    {
        //
    }
}
