<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAgentsController extends Controller
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
    protected $tableName =['chrome'=>'general_data_ua_chrome','opera'=>'general_data_ua_opera','yandex'=>'general_data_ua_yabrowser'];
    public function index($value='')
    {
        $chrome =DB::table('general_data_ua_chrome')->get();
        $opera =DB::table('general_data_ua_opera')->get();
        $yandex =DB::table('general_data_ua_yabrowser')->get();
        $chromeText ='';
        $operaText ='';
        $yandexText ='';
        foreach ($chrome as $key => $value) {
            if ($chromeText =='') {
               $chromeText =$value->ua;
               
            }else{
                 $chromeText =$chromeText."\r\n".$value->ua;
            }
        }
           foreach ($opera as $key => $value) {
            if ($operaText =='') {
               $operaText =$value->ua;
               
            }else{
                 $operaText =$operaText."\r\n".$value->ua;
            }
        }

           foreach ($yandex as $key => $value) {
            if ($yandexText =='') {
               $yandexText =$value->ua;
               
            }else{
                 $yandexText =$yandexText."\r\n".$value->ua;
            }
        }
        $data =[
            'chromeCount'=>count($chrome),
            'operaCount'=>count(  $opera),
            'yandexCount'=>count( $yandex),
            'operaText'=>$operaText,
            'chromeText'=>$chromeText,
            'yandexText'=>$yandexText,
        ];
        return view('user-agent',$data);
        
    }
    public function addUserAgent(Request $request)
    {
        $data=$request->all();
        $table =$this->tableName[$data['table']];
        $list = explode("\r\n",$data['ua']);
        DB::table($table)->delete();
        foreach ($list as $key => $value) {
            if ( $value) {
                DB::table($table)->insert(['ua'=>$value]);  
            } 
        }
            return redirect()->back()->with('message', 'Изменения сохранены ');

    }
}
