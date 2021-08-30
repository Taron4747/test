<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'general_data';
    protected $fillable  = [
    	'ip_server','site','proxy','day_time','nignht_time','state','last_ink_cookie','last_ink_prox','server_mode','description','time_active','persent_ua_chrome','persent_ua_opera','persent_ua_yandex','persent_ua_chb_chrome','persent_ua_chb_opera','persent_ua_chb_opera','persent_ua_chb_andex','cookie_table','persent_ctr','xputh_val','autch_mail','time_session_vigul','select_mail_base','last_mail_id','xputh_chb'
    ];

  	 public function linkData()
    {
        return $this->hasOne('App\Models\Link', 'id', 'site');
    }
     public function proxyData()
    {
        return $this->hasOne('App\Models\Proxy', 'id', 'proxy');
    }
}
