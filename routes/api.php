<?php

use App\Http\Controllers\Api\v1\AcceptedVisitController;
use App\Http\Controllers\Api\v1\AdministratorController;
use App\Http\Controllers\Api\v1\AppointmentsController;
use App\Http\Controllers\Api\v1\AwardsPublicationController;
use App\Http\Controllers\Api\v1\BoardCertificationController;
use App\Http\Controllers\Api\v1\ClinicAddressController;
use App\Http\Controllers\Api\v1\DoctorController;
use App\Http\Controllers\Api\v1\DoctorScheduleController;
use App\Http\Controllers\Api\v1\EthnicityController;
use App\Http\Controllers\Api\v1\IntakeQuestionsController;
use App\Http\Controllers\Api\v1\LicenseDetailController;
use App\Http\Controllers\Api\v1\LicenseTypeController;
use App\Http\Controllers\Api\v1\PatientController;
use App\Http\Controllers\Api\v1\UsersController;
use App\Http\Controllers\Api\v1\PractitionerController;
use App\Http\Controllers\Api\v1\PractitionerEducationController;
use App\Http\Controllers\Api\v1\PractitionerEthnicityController;
use App\Http\Controllers\Api\v1\PractitionerHospitalAffiliationController;
use App\Http\Controllers\Api\v1\PractitionerResidentialAddressController;
use App\Http\Controllers\Api\v1\PractitionerSpecialtyController;
use App\Http\Controllers\Api\v1\SpecialTypeController;
use App\Http\Controllers\Api\v1\PractitionerScheduleController;
use App\Http\Controllers\Api\v1\PractitionersDashboardController;
use App\Http\Controllers\Api\v1\RawEmailController;
use App\Http\Controllers\Api\v1\DropDownsController;
use App\Http\Controllers\Api\v1\ProviderController;
use App\Http\Controllers\Api\v1\RawStripeController;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function() {
    // Route::apiResource('doctors', DoctorController::class);
    // Route::apiResource('patients', PatientController::class);
    // Route::apiResource('intakes', IntakeQuestionsController::class);

    // Route::post('send-email', [PatientController::class, 'send_email']);

    // Route::prefix('patients')->group(function() {
    //     Route::post('appointment/add',[AppointmentsController::class, 'store']);
    //     Route::get('appointment/bookings',[AppointmentsController::class, 'bookings']);
    // });

    Route::post('send-raw-email', [RawEmailController::class, 'send_raw_email']);

    Route::prefix('stripe')->group(function() {
        Route::prefix('payment-method')->group(function() {
            Route::post('create', [RawStripeController::class, 'create_payment_method']);    
            Route::get('list', [RawStripeController::class, 'list_payment_method']);    
        });
    });
});

Route::prefix('v1')->group(function() {
    Route::post('login', [UsersController::class, 'authenticate']);
    // Route::post('register', [UsersController::class, 'register']);
    // Route::prefix('doctor')->group(function() {
    //     Route::post('register', [DoctorController::class, 'register']);
    // });

    // Route::prefix('providers')->group(function() {
    //     Route::post('register', [ProviderController::class, 'register']);
    // });

    Route::prefix('register')->group(function() {
        Route::post('administrators', [AdministratorController::class, 'register']);
    });

    //DROPDOWNS
    Route::prefix("dropdowns")->group(function() {
        Route::get("genders", [DropDownsController::class, 'gender_types']); 
        Route::get("licenses", [DropDownsController::class, 'license_types']); 
        Route::get("profiles", [DropDownsController::class, 'profile_types']); 
        Route::get("specialties", [DropDownsController::class, 'specialty_types']); 
        Route::get("ethnicities", [DropDownsController::class, 'ethnicities']); 
        Route::get("faiths", [DropDownsController::class, 'faiths']); 
        Route::get("visit-reasons", [DropDownsController::class, 'visit_reasons']); 
        Route::get("suffixes", [DropDownsController::class, 'suffixes']); 
        Route::get("focus-areas", [DropDownsController::class, 'focus_areas']); 
        Route::get("modalities", [DropDownsController::class, 'modalities']); 
        Route::get("age-ranges", [DropDownsController::class, 'age_ranges']); 
        Route::get("treatment-approaches", [DropDownsController::class, 'treatment_approaches']); 
        Route::get("languages", [DropDownsController::class, 'languages']); 
    });
});


// Route::prefix('v1')->group(function() {
//     Route::get('practitioners/schedules', [PractitionersDashboardController::class, 'index']);
//     Route::get('practitioners/{practitioner_id}/general/info', [PractitionersDashboardController::class, 'practitioner_general_info']);
// });

Route::middleware(['auth:sanctum'])->group(function () {
    // Route::prefix('v1/doctor')->group(function() {
    //     Route::apiResource('schedule', DoctorScheduleController::class);
    // });

    Route::prefix('v1')->group(function() {

        Route::prefix('administrator')->group(function() {
            Route::patch('/update', [AdministratorController::class, 'update']);
            Route::get('my-info', [AdministratorController::class, 'show']);
        });

        Route::prefix('providers')->group(function() {
            Route::post('add', [PractitionerController::class, 'store']);

            Route::middleware(['user_security'])->group(function() {

                Route::prefix('update')->group(function() {
                    Route::patch('listing-details/{id}', [PractitionerController::class, 'update']);
                    Route::patch('clientele-seen/{id}', [PractitionerController::class, 'update_clientele']);
                });

                Route::prefix('info')->group(function() {
                    Route::get('listing-details/{id}', [PractitionerController::class, 'show']);
                    Route::get('clientele-seen/{id}', [PractitionerController::class, 'show_clientele']);
                });
                
                Route::get('all', [PractitionerController::class, 'index']);
            });

            Route::apiResource('schedules', PractitionerScheduleController::class);
        });

        // Route::prefix('providers')->group(function() {
        //     Route::patch('/update', [ProviderController::class, 'update']);
        //     Route::get('my-info', [ProviderController::class, 'show']);
        // });
        
        
        
        //License Types
        // Route::apiResource('license-types', LicenseTypeController::class);

        // //Specialty Types
        // Route::apiResource('specialty-types', SpecialTypeController::class);

        // //License Types
        // Route::apiResource('ethnicities', EthnicityController::class);

        // //Accepted Visit
        // Route::apiResource('accepted-visit', AcceptedVisitController::class);

        // //Awards Publications
        // Route::apiResource('award-publications', AwardsPublicationController::class);

        // //Board Certifications
        // Route::apiResource('board-certifications', BoardCertificationController::class);

        // //Clinic Addresses
        // Route::apiResource('clinic-addresses', ClinicAddressController::class);

        // //Residentials Addresses
        // Route::apiResource('residential-addresses', PractitionerResidentialAddressController::class);

        // //Practioner Education
        // Route::apiResource('practitioner-education', PractitionerEducationController::class);

        // //Practioner Ethnicities
        // Route::apiResource('practitioner-ethnicities', PractitionerEthnicityController::class);

        // //Practioner Specialties
        // Route::apiResource('practitioner-specialties', PractitionerSpecialtyController::class);

        // //Practioner Hospital Affiliations
        // Route::apiResource('hospital-affiliation', PractitionerHospitalAffiliationController::class);

        // //License Details
        // Route::apiResource('license-details', LicenseDetailController::class);

        // //Practioner Schedule
        // Route::apiResource('practitioner-schedules', PractitionerScheduleController::class);        
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});