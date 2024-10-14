<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vaccination;
use App\Models\VaccineCenter;
use Carbon\Carbon;

class RegistrationService
{
    public function registerUser($data)
    {
        // Get the vaccine center
        $vaccineCenter = VaccineCenter::find($data['vaccine_center_id']);

        // Schedule the user's vaccination based on first-come, first-serve
        $scheduledDate = $this->scheduleVaccination($vaccineCenter, $data);

        // Create the user
        $user = User::create([
            'nid' => $data['nid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => 'Scheduled', // Set status to Scheduled
        ]);

        // Create the vaccination entry for the user
        Vaccination::create([
            'user_id' => $user->id,
            'vaccine_center_id' => $vaccineCenter->id,
            'scheduled_date' => $scheduledDate,
        ]);

        if($scheduledDate != Carbon::createFromFormat('Y-m-d', $data['date'])) {
            $message = "Sorry! the selected date is not available. Your earliest vaccination date is set to {$scheduledDate}";
        } else {
            $message = "Congratulation! Your vaccination date is set to {$scheduledDate}";
        }

        return [
            'user' => $user,
            'message' => $message
        ];
    }

    // Logic to calculate the next available date based on daily limits and weekdays
    protected function scheduleVaccination(VaccineCenter $vaccineCenter, $data)
    {
        $date = Carbon::createFromFormat('Y-m-d', $data['date']);

        // Ensure the date falls on a weekday (Sunday to Thursday)
        while (!$this->isWeekday($date)) {
            $date->addDay();
        }

        // Find the first available date with capacity
        while ($this->vaccinationCountForDate($vaccineCenter, $date) >= $vaccineCenter->daily_limit) {
            $date->addDay();

            // Ensure the date falls on a weekday (Sunday to Thursday)
            while (!$this->isWeekday($date)) {
                $date->addDay();
            }
        }

        return $date;
    }

    // Check if a date is a weekday (Sunday to Thursday)
    protected function isWeekday(Carbon $date)
    {
        return $date->isWeekday() && $date->dayOfWeek !== Carbon::FRIDAY && $date->dayOfWeek !== Carbon::SATURDAY;
    }

    // Count vaccinations scheduled for a specific date
    protected function vaccinationCountForDate(VaccineCenter $vaccineCenter, Carbon $date)
    {
        return Vaccination::where('vaccine_center_id', $vaccineCenter->id)
                          ->whereDate('scheduled_date', $date->toDateString())
                          ->count();
    }
}
