<?php

namespace App\Http\Contracts\Services;

use Dotenv\Exception\ValidationException;

interface AppointmentServiceContract
{
    /**
     * Create new appointment
     *
     * @param  int $dentist
     * @param  int $service
     * @param  string $name
     * @param  string $phone
     * @return void
     */
    public function create(int $dentist, int $service, string $name, string $phone): void;





    /**
     * Appointment validation
     *
     * @throws Validationexception
     * @return bool
     */
    public function validate(): bool;
}
