<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable=[
        'image', 'youtube_link'
    ];

    public function translations()
    {
        return $this->hasMany(AboutTranslation::class, 'about_id', 'id');
    }

}
