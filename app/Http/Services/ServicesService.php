<?php

namespace App\Http\Services;

use App\Http\Contracts\Services\ServicesServiceContract;
use App\Models\Service;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class ServicesService implements ServicesServiceContract
{
    public function validateId(int $id): bool
    {
        $validated = Validator::make(['id' => $id], ['id' => 'required|integer|exists:services,id']);

        if ($validated->fails())
        {
            throw new ValidationException($validated->messages(), 400);
        }

        return true;
    }





    public function validateData(): bool
    {
        $validated = Validator::make(Request::post(), [
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'dentists' => 'required|json',
            'image' => 'required|url'
        ]);

        if ($validated->fails())
        {
            throw new ValidationException($validated->messages(), 400);
        }

        return true;
    }





    public function create(string $name, int $price, string $description, string $dentists, string $image): void
    {
        $Service = new Service();

        $Service->name = $name;
        $Service->price = $price;
        $Service->description = $description;
        $Service->dentists = $dentists;
        $Service->image = $image;

        $Service->save();
    }
}
