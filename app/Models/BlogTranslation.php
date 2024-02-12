<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'language_id', 'blog_id'
    ];
    public function blogs()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
}
