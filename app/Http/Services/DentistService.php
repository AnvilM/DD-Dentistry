<?php

namespace App\Http\Services;

use App\Http\Contracts\Services\DentistServiceContract;
use App\Models\Dentist;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class DentistService implements DentistServiceContract
{
    public function validateId(int $id): bool
    {
        $validated = Validator::make(['id' => $id], ['id' => 'required|integer|exists:dentists,id']);

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
            'position' => 'required|string',
            'bio' => 'required|string',
            'services' => 'required|json'
        ]);

        if ($validated->fails())
        {
            throw new ValidationException($validated->messages(), 400);
        }

        return true;
    }





    public function create(string $name, string $position, string $bio, string $services): void
    {
        $Dentist = new Dentist();

        $Dentist->name = $name;
        $Dentist->position = $position;
        $Dentist->bio = $bio;
        $Dentist->services = $services;

        $Dentist->save();
    }
}
