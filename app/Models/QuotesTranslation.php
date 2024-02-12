<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotesTranslation extends Model
{
    use HasFactory;
    protected $fillable=[
        'title', 'description', 'quote_id', 'language_id'
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

}
