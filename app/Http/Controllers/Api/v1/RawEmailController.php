<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RawEmailController extends Controller
{
    public function send_raw_email(Request $request){
        $validated = $request->validate([
            'type' => 'required',
            'email' => 'required|email|max:255',
        ]);
        
        $return = GlobalHelper::response( GlobalHelper::send_email($validated['type'], $validated['email'], [], 'bigdadimix@gmail.com') );

        return response()->json($return);
    }
}