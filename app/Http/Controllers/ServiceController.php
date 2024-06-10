<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\ServicesServiceContract;
use App\Models\Service;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(Service::all());
    }





    public function show(Request $request, ServicesServiceContract $servicesService)
    {
        try
        {
            if ($servicesService->validateId($request->route('id')))
            {
                return response()->json(Service::where('id', $request->route('id'))->first());
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }





    public function store(Request $request, ServicesServiceContract $servicesService)
    {
        try
        {
            if ($servicesService->validateData())
            {
                $name = $request->post('name');
                $price = $request->post('price');
                $description = $request->post('description');
                $dentists = $request->post('dentists');
                $image = $request->post('image');

                $servicesService->create($name, $price, $description, $dentists, $image);
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }





    public function update(Request $request, ServicesServiceContract $servicesService)
    {
        try
        {
            if ($servicesService->validateId($request->route('id')) && $servicesService->validateData())
            {
                $name = $request->post('name');
                $price = $request->post('price');
                $description = $request->post('description');
                $dentists = $request->post('dentists');
                $image = $request->post('image');

                Service::where('id', $request->route('id'))->update([
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'dentists' => $dentists,
                    'image' => $image
                ]);
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }





    public function delete(Request $request, ServicesServiceContract $servicesService)
    {
        try
        {
            if ($servicesService->validateId($request->route('id')))
            {
                Service::where('id', $request->route('id'))->delete();
            }
        }
        catch (ValidationException $e)
        {
            throw new HttpResponseException(response($e->getMessage(), $e->getCode()));
        }
    }
}
