<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\PractitionerSchedule;
use App\Http\Requests\StorePractitionerScheduleRequest;
use App\Http\Requests\UpdatePractitionerScheduleRequest;
use App\Http\Resources\PractitionerResource;
use App\Helpers\GlobalHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class PractitionerScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $practitioner_schedules = QueryBuilder::for(PractitionerSchedule::class)
        ->where('creator_id', Auth::id())
        ->allowedFilters(['day', 'creator_id'])
        ->defaultSort('created_at')
        ->allowedSorts(['day', 'start_time', 'end_time'])
        ->paginate();

        return new PractitionerResource($practitioner_schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $schedule_data = [];
            $schedules = $request->all();
            $timestamp = Carbon::now()->format("Y-m-d H:i:s");

            foreach($schedules as $schedule) {
                $validated = Validator::make($schedule, RulesHelper::practitioner_schedules_store_rules());
                if ($validated->fails()) {
                    return GlobalHelper::errorResponse([
                        'status' => 'error',
                        'message' => 'Invalid schedule value',
                    ], 400);
                }
                $schedule['creator_id'] = Auth::id();
                $schedule['created_at'] = $timestamp;
                $schedule_data[] = $schedule;
            }
            
            $practitioner_schedules = PractitionerSchedule::insert($schedule_data);
            
            return GlobalHelper::response([
                'status' => 'ok',
                'message' => 'Schedules Successfully Saved!'
            ], 200);
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
        return new PractitionerResource(PractitionerSchedule::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePractitionerScheduleRequest $request, PractitionerSchedule $practitioner_schedules, $id)
    {
        try {
            $validated = $request->validate(RulesHelper::practitioner_schedules_store_rules());
            $practitioner_schedule = $practitioner_schedules->find($id);
            if ($practitioner_schedule->update($validated)) {
                return GlobalHelper::response([
                    'status' => 'ok',
                    'message' => 'Schedule Successfully Updated!'
                ], 200);
            } else {
                return GlobalHelper::errorResponse([
                    'status' => 'error',
                    'message' => 'Failed to update the data!',
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
    public function destroy(PractitionerSchedule $practitioner_schedules, $id)
    {
        try {
            $practitioner_schedule = $practitioner_schedules->find($id);
            if ($practitioner_schedule->delete()) {
                return GlobalHelper::response([
                    'status' => 'ok',
                    'message' => 'Schedule Deleted!'
                ], 200);
            } else {
                return GlobalHelper::errorResponse([
                    'status' => 'error',
                    'message' => 'Failed to delete the data!',
                ], 400);
            }        
        } catch (ValidationException $ve) {
            return GlobalHelper::errorResponse([
                'status' => 'error',
                'message' => $ve->validator->errors(),
            ], 400);
        }
    }
}