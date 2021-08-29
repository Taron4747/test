<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yandex extends Model
{
    use HasFactory;
    protected $table = 'general_data_ua_yabrowser';
    protected $fillable  = [
    	'name','description'
    ];

     
}
