<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutsideMessage extends Model
{
    use HasFactory;
    protected $fillable=[
        'name and surname', 'phone', 'email', 'message', 'subject'
    ];
}
