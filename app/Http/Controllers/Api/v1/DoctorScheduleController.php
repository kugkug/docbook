<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorScheduleRequest;
use App\Http\Requests\UpdateDoctorScheduleRequest;
use App\Http\Resources\DoctorScheduleCollection;
use App\Http\Resources\DoctorScheduleResource;
use App\Models\DoctorSchedule;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class DoctorScheduleController extends Controller
{
    // use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor_schedules = QueryBuilder::for(DoctorSchedule::class)
        ->allowedFilters(['day', 'creator_id'])
        ->defaultSort('created_at')
        ->allowedSorts(['day', 'start_time', 'end_time'])
        ->get();

        return new DoctorScheduleResource($doctor_schedules);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorScheduleRequest $request)
    {
        $validated = $request->validated();
        $doctor_schedule = Auth::user()->doctor_schedules()->create($validated);
        // DoctorSchedule::create($validated);
        return new DoctorScheduleResource($doctor_schedule);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        return new DoctorScheduleResource(DoctorSchedule::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorScheduleRequest $request, DoctorSchedule $doctor_schedule, $id)
    {
        try {
            $validated = $request->validated();
            $schedule_data = $doctor_schedule->find($id);
            if ($schedule_data->update($validated)) {
                return new DoctorScheduleResource($schedule_data);
            } else {
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Failed to update data',
                ]);
            }
        } catch (ValidationException $ve) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $ve->validator->errors(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorSchedule $doctor_schedule, $id)
    {
        

        $schedule_data = $doctor_schedule->find($id);
        if ($schedule_data->delete()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Schedule Deleted',
            ], 200);
        } else {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Failed to update data',
            ], 400);
        }        
    }
}
