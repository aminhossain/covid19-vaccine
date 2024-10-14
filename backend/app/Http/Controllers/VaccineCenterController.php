<?php

namespace App\Http\Controllers;

use App\Services\VaccineCenterService;
use Illuminate\Http\JsonResponse;

class VaccineCenterController extends Controller
{
    protected $vaccineCenterService;

    public function __construct(VaccineCenterService $vaccineCenterService)
    {
        $this->vaccineCenterService = $vaccineCenterService;
    }

    /**
     * Fetch all vaccine centers.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $centers = $this->vaccineCenterService->getAllVaccineCenters();

        return response()->json($centers);
    }
}
