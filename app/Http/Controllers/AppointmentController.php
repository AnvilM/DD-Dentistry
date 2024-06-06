<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\AppointmentServiceContract;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        //
    }





    public function show()
    {
        //
    }





    public function store(Request $request, AppointmentServiceContract $appointmentService)
    {
        try
        {
            $appointmentService->validate();
        }
        catch (Exception $e)
        {
            throw new HttpResponseException(response()->json($e->getMessage(), $e->getCode()));
        }

        $dentist = $request->post('dentist');
        $service = $request->post('service');
        $name = $request->post('name');
        $phone = $request->post('phone');

        $appointmentService->create($dentist, $service, $name, $phone);
    }
}
