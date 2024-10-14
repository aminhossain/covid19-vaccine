<?php

namespace App\Services;

use App\Models\User;

class SearchService
{
    /**
     * Find vaccination status by NID.
     *
     * @param string $nid
     * @return array
     */
    public function findStatusByNID(string $nid): array
    {
        $registration = User::with('vaccination')->where('nid', $nid)->first();

        if (!$registration) {
            return [
                'status' => 'Not registered',
                'message' => 'No registration found. Please register for vaccination.',
            ];
        }

        // Determine status based on registration data
        $currentDate = now();
        
        if ($registration->vaccination->scheduled_date && $currentDate->gt($registration->vaccination->scheduled_date)) {
            return [
                'status' => 'Vaccinated',
                'message' => 'You have been vaccinated on ' . $registration->vaccination->scheduled_date,
            ];
        } elseif ($registration->vaccination->scheduled_date) {
            return [
                'status' => 'Scheduled',
                'scheduled_date' => $registration->vaccination->scheduled_date,
                'message' => 'Your vaccination is scheduled for ' . $registration->vaccination->scheduled_date,
            ];
        } else {
            return [
                'status' => 'Not scheduled',
                'message' => 'You are registered but not yet scheduled for vaccination.',
                'data' => $registration,
            ];
        }
    }
}
