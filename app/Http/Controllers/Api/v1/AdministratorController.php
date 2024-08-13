<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Http\Requests\StoreAdministratorRequest;
use App\Http\Requests\UpdateAdministratorRequest;
use App\Http\Resources\PractitionerResource;
use App\Models\Gender;
use App\Models\Practitioner;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdministratorController extends Controller
{
    public function register(StoreAdministratorRequest $request)
    {
        DB::beginTransaction();
        
        try {
            $default_password = GlobalHelper::encrypt(GlobalHelper::generateDefaultPassword());
            $decrypted = GlobalHelper::decrypt($default_password);
            $admin_data = $request->all();

            $user_data = [
                'name' => $admin_data['first_name'].' '.$admin_data['last_name'],
                'email' => $request['email'],
                'user_type' => Practitioner::PROFILE_TYPE['admin'],
                'password' => GlobalHelper::decrypt($default_password),
            ];
            //Add User
            $user = User::create($user_data); 

            $admin_data['creator_id'] = $user->id;
            $admin_saved = Administrator::create($admin_data);

            GlobalHelper::send_email("new_password", $request->email, ['password' => $decrypted]);
            
            DB::commit();
            
            return GlobalHelper::response([
                'message' => 'saved',
                'data' => $admin_saved,
                'password' => $decrypted
            ], 200);

        } catch(\Exception $e) {
            DB::rollBack();
            return GlobalHelper::response([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function show() {
        $data = Administrator::get()->first();
        return GlobalHelper::response([
            'info' => $data
        ], 200);
    }
}