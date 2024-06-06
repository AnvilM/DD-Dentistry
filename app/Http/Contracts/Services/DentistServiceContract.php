<?php

namespace App\Http\Contracts\Services;

use Dotenv\Exception\ValidationException;

interface DentistServiceContract
{

    /**
     * Checks if dantist exists
     *
     * @param  int $id
     * 
     * @throws ValidationException
     * @return bool
     */
    public function validateId(int $id): bool;





    /**
     * Validate data to store dantist
     *
     * @throws ValidationException
     * @return bool
     */
    public function validateData(): bool;





    /**
     * Create dentist
     *
     * @param  string $name
     * @param  string $position
     * @param  string $bio
     * @param  string $services
     * 
     * @return void
     */
    public function create(string $name, string $position, string $bio, string $services): void;
}
