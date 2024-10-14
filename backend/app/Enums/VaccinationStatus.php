<?php
namespace App\Enums;

enum VaccinationStatus: string
{
    case NotRegistered = 'Not registered';
    case NotScheduled = 'Not scheduled';
    case Scheduled = 'Scheduled';
    case Vaccinated = 'Vaccinated';
}

