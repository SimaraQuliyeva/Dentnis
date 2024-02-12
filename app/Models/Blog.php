<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'image', 'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'idid');
    }

    public function translations(){
        return $this->hasMany(BlogTranslation::class);
    }
//    public function translation(){
//        return $this->belongsTo(BlogTranslation::class, 'blog_id', 'id');
//    }
}
