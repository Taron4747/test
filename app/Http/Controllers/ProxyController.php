<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proxy;
use App\Models\ProxyList;

class ProxyController extends Controller
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
    public function getProxy()
    {
        return view('proxy');
    }
    public function getProxyData(Request $request)
    {
        $data = $request->all();       
        $proxies =  Proxy::all();
        $totalData = count($proxies);
        $totalFiltered = $totalData; 

        $data = array();
        if(!empty($proxies))
        {
            foreach ($proxies as $proxy)
            {
                
                $nestedData['id'] = $proxy->id;
                $nestedData['name'] = $proxy->name;
                $nestedData['description'] = $proxy->description;
                $nestedData['action'] = $this->getActions($proxy->id);     
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
                            <li><a class="proxy_edit" data-id="'.$id.'"><i class="icon-pencil5"></i> Edit</a></li>
                            <li><a class="proxy_remove" data-toggle="modal" data-target="#modal_form_inline" data-id="'.$id.'"><i class="icon-folder-remove"></i> Remove</a></li>
                            <li><a class="proxy_list" data-id="'.$id.'"><i class="icon-list"></i>Proxy list</a></li>
                        </ul>
                    </li>
                </ul>';
                return $html;

    }
    public function addProxy(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'proxy_list' => 'required'
        ]);
        $data =$request->all();
         if ($data['proxy_id']) {
            Proxy::where('id',$data['proxy_id'])->update(['name'=>$data['name'],'description'=>$data['description']]);
            ProxyList::where('proxy_id',$data['proxy_id'])->delete();
            $this->addProxyList($data['proxy_id'],$data['proxy_list']);
            return redirect()->back()->with('message', 'Proxy Изменен');

        }else{
            $proxyList =$data['proxy_list'];
            unset($data['_token']);
            unset($data['proxy_list']);
            unset($data['proxy_id']);
            $proxy =Proxy::create($data);
            $this->addProxyList($proxy->id, $proxyList);

            return redirect()->back()->with('message', 'Proxy добавлен');

        }
      
    }
    public function addProxyList($id,$proxyList)
    {
        $proxyListArray =  $input []= explode("\r\n",$proxyList);
        foreach ($proxyListArray as $key => $value) {
            if ($value) {
                ProxyList::insert(['proxy_id'=>$id,'proxy_name'=> $value]);
            }
        }
    }
    public function getProxyById($id)
    {
        $proxy =Proxy::where('id',$id)->with('list')->first();
       $list = $proxy->list->toArray();
        $proxyList ='';
       foreach ($list as $key => $value) {
        if ($proxyList =='') {
           $proxyList =$value['proxy_name'];
           
        }else{
             $proxyList =$proxyList."\r\n".$value['proxy_name'];
        }
       }
       $data =[
        'name'=>$proxy->name,
        'description'=>$proxy->description,
        'list'=>$proxyList,
        'id'=>$id,
       ];
         return response()->json(array(
                'success' => 1,
                'status_code' => 200,
                'data' => $data
            ));
    }
    public function removeProxy(Request $request)
    {
        $data =$request->all();
        Proxy::where('id',$data['id'])->delete();
        ProxyList::where('proxy_id',$data['id'])->delete();
        return redirect()->back()->with('message', 'Proxy Удален');

    }
}
