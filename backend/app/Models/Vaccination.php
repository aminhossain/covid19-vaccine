<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vaccine_center_id', 'scheduled_date'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with VaccineCenter
    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
