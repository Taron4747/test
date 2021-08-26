<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkList extends Model
{
    use HasFactory;
    protected $table = 'links_list';
    protected $fillable  = [
    	'link_id','link_name'
    ];

     public function link()
    {
        return $this->belongsTo('App\Models\Link', 'link_id', 'id');
    }
}
