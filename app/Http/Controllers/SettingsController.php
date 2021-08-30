<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\SettingsList;
use App\Models\Link;
use App\Models\Mail;
use App\Models\Proxy;
use App\Models\Cookie;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
      
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected $modes =[1=>'Work','To Walk','New'];
    public function getSettings()
    {
        $data['links']=Link::select('id','name')->get();
        $data['mails']=Mail::select('id','name')->get();
        $data['proxies']=Proxy::select('id','name')->get();
        $data['cookies']=Cookie::select('id','name')->get();
        return view('settings',$data);
    }
    public function getSettingsData(Request $request)
    {
        $data = $request->all();       
        $settings =  Settings::with('linkData','proxyData')->get();
        $totalData = count($settings);
        $totalFiltered = $totalData; 
        $data = array();
        if(!empty($settings))
        {
            foreach ($settings as $setting)
            {

                $nestedData['ip_server'] = long2ip($setting->ip_server);
                $nestedData['site'] =$setting->linkData&&$setting->linkData->count() ? $setting->linkData->name :'';
                $nestedData['description'] = $setting->description;
                $nestedData['mode'] = $this->modes[$setting->server_mode];
                $nestedData['proxy'] = $setting->proxyData&&$setting->proxyData->count() ?$setting->proxyData->name:'';
                $nestedData['day_time'] = $setting->day_time;
                $nestedData['nignht_time'] = $setting->nignht_time;
                $nestedData['persentChrome'] = $setting->persent_ua_chrome;
                $nestedData['persentOpera'] = $setting->persent_ua_opera;
                $nestedData['persentYandex'] = $setting->persent_ua_yandex;
                $nestedData['action'] = $this->getActions($setting->id);     
                $data[] = $nestedData;
            }
            
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 

    }
    public function getActions($id)
    {
        $html ='<ul class="icons-list">
                    <li class="dropdown close">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="setting_edit" data-id="'.$id.'"><i class="icon-pencil5"></i> Edit</a></li>
                            <li><a class="setting_remove" data-toggle="modal" data-target="#modal_form_inline" data-id="'.$id.'"><i class="icon-folder-remove"></i> Remove</a></li>
                        </ul>
                    </li>
                </ul>';
                return $html;

    }
    public function addSetting(Request $request)
    {
        $request->validate([
            'persentChrome' => 'required',
            'persentOpera' => 'required',
            'persentYandex' => 'required',
            'site' => 'required',
            'proxy' => 'required',
            'day_time' => 'required',
            'nignht_time' => 'required',
            'xputh_val' => 'required',
            'cookies' => 'required',
            'timeToWalk' => 'required',
            'select_mail_base' => 'required',
            'ctr' => 'required',
            'ip_server' => 'required',
            'description' => 'required',
        ]);
            $data =$request->all();
            $insertData['ip_server'] = ip2long($_POST['ip_server']);
            $insertData['persent_ua_chrome']    = intval($_POST['persentChrome']);
            $insertData['persent_ua_opera']     = intval($_POST['persentOpera']);
            $insertData['persent_ua_yandex']   = intval($_POST['persentYandex']);
            $insertData['persent_ua_chb_chrome'] = isset($_POST['cbxChrome']) && $_POST['cbxChrome'] == 1? 1:0;
            $insertData['persent_ua_chb_opera']  = isset($_POST['cbxOpera'])  && $_POST['cbxOpera']  == 1? 1:0;
            $insertData['persent_ua_chb_andex']  = isset($_POST['cbxYandex']) && $_POST['cbxYandex'] == 1? 1:0;
            $insertData['xputh_chb']  = isset($_POST['xputh_chb']) && $_POST['xputh_chb'] == 1? 1:0;
            $insertData['site'] = $_POST['site'];
            $insertData['proxy'] = $_POST['proxy'];
            $insertData['day_time'] = $_POST['day_time'];
            $insertData['nignht_time'] = $_POST['nignht_time'];
            $insertData['xputh_val'] = $_POST['xputh_val'];
            $insertData['server_mode'] = $_POST['mode'];
            $insertData['cookie_table'] = $_POST['cookies'];
            $insertData['time_session_vigul'] = $_POST['timeToWalk'];
            $insertData['description'] = $_POST['description'];
            $insertData['persent_ctr'] = $_POST['ctr'];
            $insertData['state'] = 0;
            $insertData['last_ink_cookie'] = 0;
            $insertData['last_ink_prox'] = 0;
            $insertData['autch_mail'] =isset($_POST['activeAuthMail']) && $_POST['activeAuthMail'] == 1? 1:0 ; 
            $insertData['last_mail_id'] = 0;
            $insertData['select_mail_base'] = intval($_POST['select_mail_base']);
         if ($data['setting_id']) {
            Settings::where('id',$data['setting_id'])->update($insertData);
            return redirect()->back()->with('message', 'Настройка изменена ');

 
 
        }else{
            $setting =Settings::create($insertData);
            return redirect()->back()->with('message', 'Настройка добавлена');

        }
      
    }

    public function getSettingById($id)
    {
        $setting =Settings::where('id',$id)->first()->toArray();
        $setting['ip_server']=long2ip($setting['ip_server']);
         return response()->json(array(
                'success' => 1,
                'status_code' => 200,
                'data' => $setting
            ));
    }
    public function removeSetting(Request $request)
    {
        $data =$request->all();
        Settings::where('id',$data['id'])->delete();
        return redirect()->back()->with('message', 'Настройка удалена');

    }
}
