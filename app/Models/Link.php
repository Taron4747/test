<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $table = 'links';
    protected $fillable  = [
    	'name','description'
    ];

     public function list()
    {
        return $this->hasMany('App\Models\LinkList', 'link_id', 'id');
    }
}
