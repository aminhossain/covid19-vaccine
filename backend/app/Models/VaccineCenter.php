<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'daily_limit'];

    // Relationship with Vaccination
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }
}
