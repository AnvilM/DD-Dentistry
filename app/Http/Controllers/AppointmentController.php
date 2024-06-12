<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\AppointmentServiceContract;
use App\Models\Appointment;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{
    public function index()
    {
        return response()->json(Appointment::all());
    }





    public function show(Request $request, AppointmentServiceContract $appointmentService)
    {
        try
        {
            if ($appointmentService->validateId($request->route('id')))
            {
                return response()->json(Appointment::where('id', $request->route('id'))->first());
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
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




    public function delete(Request $request)
    {
        Appointment::where('id', $request->route('id'))->delete();
    }
}
