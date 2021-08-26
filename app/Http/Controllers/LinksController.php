<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\LinkList;

class LinksController extends Controller
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
    public function getLink()
    {
        return view('links');
    }
    public function getLinkData(Request $request)
    {
        $data = $request->all();       
        $links =  Link::all();
        $totalData = count($links);
        $totalFiltered = $totalData; 

        $data = array();
        if(!empty($links))
        {
            foreach ($links as $link)
            {
                
                $nestedData['id'] = $link->id;
                $nestedData['name'] = $link->name;
                $nestedData['description'] = $link->description;
                $nestedData['action'] = $this->getActions($link->id);     
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
                            <li><a class="link_edit" data-id="'.$id.'"><i class="icon-pencil5"></i> Edit</a></li>
                            <li><a class="link_remove" data-toggle="modal" data-target="#modal_form_inline" data-id="'.$id.'"><i class="icon-folder-remove"></i> Remove</a></li>
                            <li><a class="link_list" data-id="'.$id.'"><i class="icon-list"></i>Link list</a></li>
                        </ul>
                    </li>
                </ul>';
                return $html;

    }
    public function addLink(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'link_list' => 'required'
        ]);
        $data =$request->all();
         if ($data['link_id']) {
            Link::where('id',$data['link_id'])->update(['name'=>$data['name'],'description'=>$data['description']]);
            LinkList::where('link_id',$data['link_id'])->delete();
            $this->addLinkList($data['link_id'],$data['link_list']);
            return redirect()->back()->with('message', 'Link Изменен');

        }else{
            $linkList =$data['link_list'];
            unset($data['_token']);
            unset($data['link_list']);
            unset($data['link_id']);
            $link =Link::create($data);
            $this->addLinkList($link->id, $linkList);

            return redirect()->back()->with('message', 'Link добавлен');

        }
      
    }
    public function addLinkList($id,$linkList)
    {
        $linkListArray =  $input []= explode("\r\n",$linkList);
        foreach ($linkListArray as $key => $value) {
            if ($value) {
               LinkList::insert(['link_id'=>$id,'link_name'=> $value]);
            }
        }
    }
    public function getLinkById($id)
    {
        $link =Link::where('id',$id)->with('list')->first();
       $list = $link->list->toArray();
        $linkList ='';
       foreach ($list as $key => $value) {
        if ($linkList =='') {
           $linkList =$value['link_name'];
           
        }else{
             $linkList =$linkList."\r\n".$value['link_name'];
        }
       }
       $data =[
        'name'=>$link->name,
        'description'=>$link->description,
        'list'=>$linkList,
        'id'=>$id,
       ];
         return response()->json(array(
                'success' => 1,
                'status_code' => 200,
                'data' => $data
            ));
    }
    public function removeLink(Request $request)
    {
        $data =$request->all();
        Link::where('id',$data['id'])->delete();
        LinkList::where('link_id',$data['id'])->delete();
        return redirect()->back()->with('message', 'Link Удален');

    }
}
