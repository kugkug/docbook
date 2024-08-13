<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\AcceptedVisit;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class AcceptedVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $accepted_visits = QueryBuilder::for(AcceptedVisit::class)
        ->where('creator_id', Auth::id())
        ->paginate();
            
        return $accepted_visits;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(RulesHelper::accepted_visit_store_rules());
            $accepted_visit = Auth::user()->accepted_visits()->create($validated);
            
            if ($accepted_visit) {
                return GlobalHelper::response($accepted_visit);
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
    public function show(Request $request, $id)
    {
        return GlobalHelper::response(AcceptedVisit::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcceptedVisit $acceptedVisit)
    {
        try {
            $validated = $request->validate(RulesHelper::accepted_visit_store_rules());
            if ($acceptedVisit->update($validated)) {
                return GlobalHelper::response($acceptedVisit);
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
    public function destroy(AcceptedVisit $acceptedVisit)
    {
        //
    }
}
