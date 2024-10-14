<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Vaccination;
use Illuminate\Console\Command;
use App\Notifications\VaccinationReminder;
use Illuminate\Support\Facades\Notification;

class SendVaccinationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-vaccination-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
            
        // Get users who are scheduled for vaccination tomorrow
        $vaccinations = Vaccination::with('user')->whereDate('vaccination_date', $tomorrow)
                     ->where('status', 'Scheduled')
                     ->get();

        foreach ($vaccinations as $vaccination) {
            Notification::send($vaccination->user, new VaccinationReminder($vaccination->user, $vaccination->scheduled_date));
        }
    }
}
