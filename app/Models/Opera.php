<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opera extends Model
{
    use HasFactory;
    protected $table = 'general_data_ua_opera';
    protected $fillable  = [
    	'name','description'
    ];

     
}
