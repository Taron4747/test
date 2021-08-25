<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    use HasFactory;
    protected $table = 'proxy';
    protected $fillable  = [
    	'name','description'
    ];

     public function list()
    {
        return $this->hasMany('App\Models\ProxyList', 'proxy_id', 'id');
    }
}
