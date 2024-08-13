<?php

namespace App\Helpers;

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function getCurrentUserInfo() {
        return Auth::user();
    }

    public static function getDoctorInfo(string $email) {
        return Doctor::where('email', $email)->first();
    }
}