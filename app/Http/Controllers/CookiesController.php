<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cookie;

class CookiesController extends Controller
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
    public function getCookie()
    {
        return view('cookies');
    }
    public function getCookieData(Request $request)
    {
        $data = $request->all();       
        $cookies =  Cookie::all();
        $totalData = count($cookies);
        $totalFiltered = $totalData; 

        $data = array();
        if(!empty($cookies))
        {
            foreach ($cookies as $cookie)
            {
                
                $nestedData['ip'] = long2ip($cookie->ip);
                $nestedData['name'] = $cookie->name;
                $nestedData['description'] = $cookie->description;
                $nestedData['action'] = $this->getActions($cookie->id);     
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
                            <li><a class="cookie_edit" data-id="'.$id.'"><i class="icon-pencil5"></i> Edit</a></li>
                            <li><a class="cookie_remove" data-toggle="modal" data-target="#modal_form_inline" data-id="'.$id.'"><i class="icon-folder-remove"></i> Remove</a></li>
                        </ul>
                    </li>
                </ul>';
                return $html;

    }
    public function addCookie(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ip' => 'required',
        ]);
        $data =$request->all();
         if ($data['cookie_id']) {
            Cookie::where('id',$data['cookie_id'])->update(['name'=>$data['name'],'description'=>$data['description']]);
            return redirect()->back()->with('message', 'Cookie Изменен');

        }else{
            $cookieList =$data['cookie_list'];
            unset($data['_token']);
            unset($data['cookie_list']);
            unset($data['cookie_id']);
            $cookie =Cookie::create($data);

            return redirect()->back()->with('message', 'Cookie добавлен');

        }
      
    }

    public function getCookieById($id)
    {
        $cookie =Cookie::where('id',$id)->first()->toArray();
        $cookie['ip']=long2ip($cookie['ip']);

      
         return response()->json(array(
                'success' => 1,
                'status_code' => 200,
                'data' => $cookie
            ));
    }
    public function removeCookie(Request $request)
    {
        $data =$request->all();
        Cookie::where('id',$data['id'])->delete();
        return redirect()->back()->with('message', 'Cookie Удален');

    }
}
