<?php

namespace App\Http\Services;

use App\Http\Contracts\Services\AppointmentServiceContract;
use App\Models\Appointment;
use App\Models\Dentist;
use Dotenv\Exception\ValidationException;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppointmentService implements AppointmentServiceContract
{
    public function validateId(int $id): bool
    {
        $validated = Validator::make(['id' => $id], ['id' => 'required|integer|exists:appointments,id']);

        if ($validated->fails())
        {
            throw new ValidationException($validated->messages(), 400);
        }

        return true;
    }



    public function create(int $dentist, int $service, string $name, string $phone): void
    {
        $Appointment = new Appointment();

        $Appointment->dentist_id = $dentist;
        $Appointment->service_id = $service;
        $Appointment->name = $name;
        $Appointment->phone = $phone;

        $Appointment->save();
    }



    public function validate(): bool
    {
        $validated = Validator::make(Request::post(), [
            'dentist' => 'required|integer|exists:dentists,id',
            'service' => 'required|integer|exists:services,id',
            'name' => 'required|string',
            'phone' => 'required|string|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
        ]);

        if ($validated->fails())
        {
            throw new ValidationException($validated->messages(), 400);
            return false;
        }

        $dentist = Request::post('dentist');
        $service = Request::post('service');


        $Dentist = Dentist::where('id', $dentist)->first();
        if (!in_array($service, json_decode($Dentist->services)))
        {
            throw new ValidationException('Invalid service or dentist', 400);
            return false;
        }

        return true;
    }
}
