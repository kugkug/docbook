<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Http\Resources\DoctorResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = QueryBuilder::for(Doctor::class)
        ->allowedFilters(['id', 'firstname', 'lastname'])
        ->defaultSort('created_at')
        ->allowedSorts(['firstname', 'lastname', 'created_at'])
        ->paginate();
    
        return new DoctorResource($doctors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return [];
        // try {
        //     $validated = $request->validate(Doctor::rules); 
        //     $doctor = Doctor::create($validated);
        //     $data = DoctorResource::make($doctor);

        //     $user_data = [
        //         'name' => $request->firstname.' '.$request->lastname,
        //         'email' => $request->email,
        //         'password' => 'Pass1234',
        //     ];

        //     $user = User::create($user_data);
            
        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'ok',
        //         'status' => 'success',
        //         'data' => $data,
        //         'user_data' => [
        //             'data' => $user,
        //             'access_token' => $user->createToken('api_token')->plainTextToken,
        //             'token_type' => 'Bearer'
        //         ]
        //     ], 200);

        // } catch (ValidationException $ve) {
        //     return response()->json([
        //         'code' => 400,
        //         'status' => 'error',
        //         'message' => $ve->validator->errors(),
        //     ], 400);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return DoctorResource::make($doctor);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        try {
            $validated = $request->validate(Doctor::rules); 
            $doctor->update($validated);

            $data = DoctorResource::make($doctor);

            return response()->json([
                'code' => 200,
                'message' => 'ok',
                'status' => 'success',
                'data' => $data
            ]);

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
    public function destroy(Doctor $doctor)
    {
        //
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate(Doctor::rules); 
            $doctor = Doctor::create($validated);
            $data = DoctorResource::make($doctor);

            $user_data = [
                'name' => $request->firstname.' '.$request->lastname,
                'email' => $request->email,
                'password' => $request->password,
            ];

            $user = User::create($user_data);
            
            return response()->json([
                'code' => 200,
                'message' => 'ok',
                'status' => 'success',
                'data' => $data,
                'user_data' => [
                    'data' => $user,
                    'access_token' => $user->createToken('api_token')->plainTextToken,
                    'token_type' => 'Bearer'
                ]
            ], 200);

        } catch (ValidationException $ve) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $ve->validator->errors(),
            ], 400);
        }
    }
}
