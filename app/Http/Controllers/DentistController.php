<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\DentistServiceContract;
use App\Models\Dentist;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class DentistController extends Controller
{
    public function index()
    {
        return response()->json(Dentist::all());
    }





    public function show(Request $request, DentistServiceContract $dentistService)
    {
        try
        {
            if ($dentistService->validateId($request->route('id')))
            {
                return response()->json(Dentist::where('id', $request->route('id'))->first());
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }





    public function store(Request $request, DentistServiceContract $dentistService)
    {
        try
        {
            if ($dentistService->validateData())
            {
                $name = $request->post('name');
                $position = $request->post('position');
                $bio = $request->post('bio');
                $services = $request->post('services');

                $dentistService->create($name, $position, $bio, $services);
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }





    public function update(Request $request, DentistServiceContract $dentistService)
    {
        try
        {
            if ($dentistService->validateId($request->route('id')) && $dentistService->validateData())
            {
                $name = $request->post('name');
                $position = $request->post('position');
                $bio = $request->post('bio');
                $services = $request->post('services');

                Dentist::where('id', $request->route('id'))->update([
                    'name' => $name,
                    'position' => $position,
                    'bio' => $bio,
                    'services' => $services
                ]);
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }





    public function delete(Request $request, DentistServiceContract $dentistService)
    {
        try
        {
            if ($dentistService->validateId($request->route('id')))
            {
                Dentist::where('id', $request->route('id'))->delete();
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }
}
