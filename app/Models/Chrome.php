<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chrome extends Model
{
    use HasFactory;
    protected $table = 'general_data_ua_chrome';
    protected $fillable  = [
    	'name','description'
    ];

     
}
