<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\RulesHelper;
use App\Http\Controllers\Controller;
use App\Models\AcceptedVisit;
use App\Helpers\GlobalHelper;
use App\Models\Patient;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;

class AppointmentsController extends Controller
{
    public function store(Request $request) {
        $patient = Patient::find($request->patient_id);
        $patient->practitioners()->attach($request->practitioner_id,
            [
                'schedule_id' => $request->schedule_id
            ]
        );
    }

    public function bookings(Request $request) {
        // $products = Product::join('styles','products.style_id','styles.id')
        //         ->join('colors','products.color_id','colors.id')
        //         ->join('sizes','products.size_id','sizes.id')
        //         ->orderBy('style')
        //         ->orderBy('color')
        //         ->orderBy('size')
        //         ->select('products.id','styles.style','colors.color',
        //             'sizes.size','products.price')
        //         ->get();
        $bookings = Practitioner::orderBy('id')
        ->with('patients')
        ->with('schedules')
        ->get();
        
        return $bookings;
    }
}