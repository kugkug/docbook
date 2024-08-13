<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Resources\PractitionerResource;
use App\Models\Practitioner;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function register(StoreProviderRequest $request)
    {
        try {
            $default_password = GlobalHelper::encrypt(GlobalHelper::generateDefaultPassword());
            $decrypted = GlobalHelper::decrypt($default_password);
            $practitioner_data = $request->all();
            
            $provider_data = ['name' => $practitioner_data['first_name']." ".$practitioner_data['last_name'], ];

            $user_data = [
                'name' => $practitioner_data['first_name'].' '.$practitioner_data['last_name'],
                'email' => $request['email'],
                'user_type' => Practitioner::PROFILE_TYPE['user'],
                'password' => GlobalHelper::decrypt($default_password),
            ];
            
            $user = User::create($user_data); 

            $provider_data['creator_id'] = $user->id;
            $practitioner_data['creator_id'] = $user->id;
            $practitioner_data['profile_type'] = Practitioner::PROFILE_TYPE['user'];

            Provider::create($provider_data);
            
            $practitioner = Practitioner::create($practitioner_data);
            $practitioner_saved = PractitionerResource::make($practitioner);

            GlobalHelper::send_email("new_password", $request->email, ['password' => $decrypted]);
            
            return GlobalHelper::response([
                'message' => 'saved',
                'data' => $practitioner_saved,
            ]);

        } catch(\Exception $e) {
            
            return GlobalHelper::response([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        $practitioner = Practitioner::where('email', Auth::user()->email)->get();
        return PractitionerResource::make($practitioner);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderRequest $request, Practitioner $practitioner)
    {
        try {
            $practitioner_info = Practitioner::where('email', Auth::user()->email)->get()->first();
            
            $practitioner = Practitioner::find($practitioner_info['id']);
            $practitioner->update($request->all());
            $practitioner_saved = PractitionerResource::make($practitioner);

            return GlobalHelper::response([
                'message' => 'updated',
                'data' => $practitioner_saved,
            ]);

        } catch (ValidationException $ve) {
            return GlobalHelper::response([
                'status' => 'error',
                'message' => $ve->validator->errors(),
            ], 400);            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        //
    }
}