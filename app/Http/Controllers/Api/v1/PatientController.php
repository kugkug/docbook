<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\GlobalHelper;
use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Http\Resources\PatientResource;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = QueryBuilder::for(Patient::class)
        ->where('creator_id', Auth::id())
        ->allowedFilters(['id', 'firstname', 'lastname'])
        ->defaultSort('created_at')
        ->allowedSorts(['firstname', 'lastname', 'created_at'])
        ->paginate();
    
        return new PatientResource($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $default_password = GlobalHelper::encrypt(GlobalHelper::generateDefaultPassword());
            $patient_data = $request->validate(RulesHelper::patient_store_rules());

            $user_data = [
                'name' => $patient_data['firstname'].' '.$patient_data['lastname'],
                'email' => $patient_data['email'],
                'user_type' => 'client',
                'password' => GlobalHelper::decrypt($default_password),
            ];

            $user = User::create($user_data);

            $patient_data['creator_id'] = $user->id;

            $patient = Patient::create($patient_data);
            $patient_saved = PatientResource::make($patient);
            $patient_saved['password'] = GlobalHelper::decrypt($default_password);

            return GlobalHelper::response([
                'message' => 'saved',
                'data' => $patient,
            ]);

        } catch(\Exception $e) {
            return GlobalHelper::response([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function send_email() {
        $mail = Mail::to('jesthonymorales@gmail.com')->send(new OtpMail(['name' => 'OTP']));

        return GlobalHelper::response([
            'message' => 'sent',
            'data' => $mail,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return PatientResource::make($patient);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        // try {
        //     $patient_data = $request->validate(RulesHelper::patient_store_rules());
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
