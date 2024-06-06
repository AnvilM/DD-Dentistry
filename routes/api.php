<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\ServiceController;
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





//Admin routes
Route::prefix('admin')->group(function ()
{
    //Appointment routes
    Route::prefix('appointment')->controller(AppointmentController::class)->group(function ()
    {
        //Get all appointments
        Route::get('/', 'index');

        //Get appointment by id
        Route::get('{id}', 'show');
    });



    //Dentist routes
    Route::prefix('dentist')->controller(DentistController::class)->group(function ()
    {
        //Create dentist
        Route::post('/', 'store');

        //Update dentist by id
        Route::put('{id}', 'update');

        //Delete dentist by id
        Route::delete('{id}', 'delete');
    });



    Route::prefix('service')->controller(ServiceController::class)->group(function ()
    {
        //Create service
        Route::post('/', 'store');

        //Update service by id
        Route::put('{id}', 'update');

        //Delete service by id
        Route::delete('{id}', 'delete');
    });
});





//Public routes
Route::prefix('public')->group(function ()
{
    //Appointment routes
    Route::prefix('appointment')->controller(AppointmentController::class)->group(function ()
    {
        //Create appointment
        Route::post('/', 'store');
    });



    //Dentist routes
    Route::prefix('dentist')->controller(DentistController::class)->group(function ()
    {
        //Get all dentists
        Route::get('/', 'index');

        //Get dentist by id
        Route::get('{id}', 'show');
    });



    Route::prefix('service')->controller(ServiceController::class)->group(function ()
    {
        //Get all services
        Route::get('/', 'index');

        //Get service by id
        Route::get('/{id}', 'show');
    });
});
