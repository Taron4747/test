<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chrome;
use App\Models\Opera;
use App\Models\Yandex;

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
    public function index($value='')
    {
        $chrome =Chrome::all();
        $opera =Opera::all();
        $yandex =Yandex::all();
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
        if ($data['table'] =='opera') {
             $modelName =new Opera;
        }
         if ($data['table'] =='yandex') {
             $modelName = new Yandex;
        }
       if ($data['table'] =='chrome') {
             $modelName = new Chrome;
        }
        $list = explode("\r\n",$data['ua']);
        $modelName->delete();

       
        foreach ($list as $key => $value) {
            if ( $value) {
                $modelName->insert(['ua'=>$value]);  
            } 
        }
            return redirect()->back()->with('message', 'Изменения сохранены ');

    }
}
