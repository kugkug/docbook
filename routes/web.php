<?php

use App\Http\Controllers\admin\ClientsController;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\IntakeQuestionsController;
use App\Http\Controllers\admin\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $data = [
        'title' =>'API Admin',
    ];
    return view('admin.login', $data);
})->name('login');

Route::group(['prefix' => 'admin'], function() {

    Route::get('/dashboard', function () {
        $data = [
            'title' =>'Dashboard',
            'header' =>'Dashboard'
        ];
        return view('admin.dashboard', $data);
    });
    
    Route::get('/doctors', [DoctorController::class, 'index'])->middleware('auth');
    Route::get('/clients', [ClientsController::class, 'index'])->middleware('auth');
    Route::get('/intakes', [IntakeQuestionsController::class, 'index'])->middleware('auth');

    Route::get('/users', [UsersController::class, 'index'])->middleware('auth');
    Route::post('/user-add', [UsersController::class, 'create'])->middleware('auth');
    Route::get('/user-edit/{id}', [UsersController::class, 'edit'])->middleware('auth');
});

Route::group(['prefix' => 'execute'], function() {
    Route::post('/user-add', [UsersController::class, 'store'])->middleware('auth');
    Route::get('/logout', [UsersController::class, 'logout'])->middleware('auth');
});

Route::post('/execute/login', [UsersController::class, 'authenticate']);
