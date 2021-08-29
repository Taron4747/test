<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    use HasFactory;
    protected $table = 'general_cookies';
    protected $fillable  = [
    	'name','description'
    ];

    
}