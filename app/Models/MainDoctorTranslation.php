<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainDoctorTranslation extends Model
{
    use HasFactory;
    protected $fillable=[
        'description'
    ];
    public function doctor()
    {
        return $this->belongsTo(MainDoctor::class, 'head_doctor_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
}
