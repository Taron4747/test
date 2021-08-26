<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailList extends Model
{
    use HasFactory;
    protected $table = 'mails_list';
    protected $fillable  = [
    	'mail_id','mail_name'
    ];

     public function mail()
    {
        return $this->belongsTo('App\Models\Mail', 'mail_id', 'id');
    }
}
