<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainDoctor extends Model
{
    use HasFactory;

    public function translations()
    {
        return $this->hasMany(MainDoctorTranslation::class, 'head_doctor_id', 'id');
    }
}
