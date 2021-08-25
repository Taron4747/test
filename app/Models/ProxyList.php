<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProxyList extends Model
{
    use HasFactory;
    protected $table = 'proxy_list';
    protected $fillable  = [
    	'proxy_id','proxy_name'
    ];

     public function proxy()
    {
        return $this->belongsTo('App\Models\Proxy', 'proxy_id', 'id');
    }
}
