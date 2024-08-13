<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\PractitionerDashboardHelper;
use App\Http\Controllers\Controller;
use App\Models\PractitionerSchedule;
use App\Models\PractitionersDashboard;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PractitionersDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = User::with('schedules')->get();
        return $schedules->toArray();
    }

    public function practitioner_general_info($id)
    {
        $return = [
            'practitioner' => User::where('id', $id)->get(),
            'information' => [
                'accepted_visit' => PractitionerDashboardHelper::accepted_visit($id),
                'award_publications' => PractitionerDashboardHelper::award_publications($id),
                'board_certifications' => PractitionerDashboardHelper::board_certifications($id),
                'clinic_address' => PractitionerDashboardHelper::clinic_address($id),
                'license_details' => PractitionerDashboardHelper::license_details($id),
                'practitioner_educaton' => PractitionerDashboardHelper::practitioner_educaton($id),
                'ethnicities' => PractitionerDashboardHelper::ethnicities($id),
                'hospital_affiliations' => PractitionerDashboardHelper::hospital_affiliations($id),
                'residential_address' => PractitionerDashboardHelper::residential_address($id),
                'specialties' => PractitionerDashboardHelper::specialties($id),
                'schedules' => PractitionerDashboardHelper::schedules($id),
            ]
        ];

        return response()->json($return);
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
    public function store(Request $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($practitioner_id)
    {
        $schedules = User::where('id', $practitioner_id)->with('schedules')->get();
        return $schedules->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PractitionersDashboard $practitionersDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PractitionersDashboard $practitionersDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PractitionersDashboard $practitionersDashboard)
    {
        //
    }
}
