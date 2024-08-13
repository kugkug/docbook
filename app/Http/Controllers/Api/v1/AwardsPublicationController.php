<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\AwardsPublication;
use App\Helpers\GlobalHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class AwardsPublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QueryBuilder::for(AwardsPublication::class)
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
            $validated = $request->validate(RulesHelper::awards_publication_store_rules());
            $awards_publications = Auth::user()->awards_publications()->create($validated);

            if ($awards_publications) {
                return GlobalHelper::response($awards_publications);
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
        return GlobalHelper::response(AwardsPublication::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AwardsPublication $awards_publications, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::awards_publication_store_rules());
            $award_publication = $awards_publications->find($id);
            
            if ($award_publication->update($validated)) {
                return GlobalHelper::response($award_publication);
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
    public function destroy(AwardsPublication $awardsPublication)
    {
        //
    }
}
