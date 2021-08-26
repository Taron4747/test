<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;
    protected $table = 'mails';
    protected $fillable  = [
    	'name','description'
    ];

     public function list()
    {
        return $this->hasMany('App\Models\MailList', 'mail_id', 'id');
    }
}
