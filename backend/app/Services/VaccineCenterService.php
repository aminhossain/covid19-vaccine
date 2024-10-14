<?php

namespace App\Services;

use App\Models\VaccineCenter;

class VaccineCenterService
{
    /**
     * Get all vaccine centers from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllVaccineCenters()
    {
        return VaccineCenter::all(); // Fetch all vaccine centers
    }
}
