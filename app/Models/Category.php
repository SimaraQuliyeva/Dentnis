<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'id'
    ];
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id', 'id');
    }

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

}
