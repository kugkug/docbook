<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index() {
        $doctors = Doctor::orderBy('firstname', 'asc')->paginate(10);
        $data = [
            'title' => 'Doctors',
            'header' => 'Doctors',
            'doctors' => $doctors
        ];
        return view("admin.doctors.index", $data);
    }
}
