<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMenuTranslation extends Model
{
    use HasFactory;
    protected $fillable=[
        'title'
    ];
    public function about()
    {
        return $this->belongsTo(AboutMenu::class, 'about_menu_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
}
