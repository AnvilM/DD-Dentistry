<?php

namespace App\Http\Contracts\Services;

use Dotenv\Exception\ValidationException;

interface ServicesServiceContract
{

    /**
     * Checks if services exists
     *
     * @param  int $id
     * 
     * @throws ValidationException
     * @return bool
     */
    public function validateId(int $id): bool;





    /**
     * Validate data to store service
     *
     * @throws ValidationException
     * @return bool
     */
    public function validateData(): bool;





    /**
     * Create service
     *
     * @param  string $name
     * @param  int $price
     * @param  string $description
     * @param  string $dentists
     * 
     * @return void
     */
    public function create(string $name, int $price, string $description, string $dentists): void;
}
