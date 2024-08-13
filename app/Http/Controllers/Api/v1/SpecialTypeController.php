<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\SpecialType;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class SpecialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(SpecialType::class)
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
            $validated = $request->validate(RulesHelper::specialty_type_store_rules());
            $special_type = SpecialType::create($validated);

            if ($special_type) {
                return GlobalHelper::response($special_type);
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
        return GlobalHelper::response(SpecialType::where('id', $id)->first());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialType $special_types, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::specialty_type_store_rules());
            $special_type = $special_types->find($id);
            
            if ($special_type->update($validated)) {
                return GlobalHelper::response($special_type);
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
    public function destroy(SpecialType $specialType)
    {
        //
    }
}
