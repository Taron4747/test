<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mail;
use App\Models\MailList;

class MailsController extends Controller
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
    public function getMail()
    {
        return view('mails');
    }
    public function getMailData(Request $request)
    {
        $data = $request->all();       
        $mails =  Mail::all();
        $totalData = count($mails);
        $totalFiltered = $totalData; 

        $data = array();
        if(!empty($mails))
        {
            foreach ($mails as $mail)
            {
                
                $nestedData['id'] = $mail->id;
                $nestedData['name'] = $mail->name;
                $nestedData['description'] = $mail->description;
                $nestedData['action'] = $this->getActions($mail->id);     
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
                            <li><a class="mail_edit" data-id="'.$id.'"><i class="icon-pencil5"></i> Edit</a></li>
                            <li><a class="mail_remove" data-toggle="modal" data-target="#modal_form_inline" data-id="'.$id.'"><i class="icon-folder-remove"></i> Remove</a></li>
                            <li><a class="mail_list" data-id="'.$id.'"><i class="icon-list"></i>Mail list</a></li>
                        </ul>
                    </li>
                </ul>';
                return $html;

    }
    public function addMail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mail_list' => 'required'
        ]);
        $data =$request->all();
         if ($data['mail_id']) {
            Mail::where('id',$data['mail_id'])->update(['name'=>$data['name'],'description'=>$data['description']]);
            MailList::where('mail_id',$data['mail_id'])->delete();
            $this->addMailList($data['mail_id'],$data['mail_list']);
            return redirect()->back()->with('message', 'Mail Изменен');

        }else{
            $mailList =$data['mail_list'];
            unset($data['_token']);
            unset($data['mail_list']);
            unset($data['mail_id']);
            $mail =Mail::create($data);
            $this->addMailList($mail->id, $mailList);

            return redirect()->back()->with('message', 'Mail добавлен');

        }
      
    }
    public function addMailList($id,$mailList)
    {
        $mailListArray =  $input []= explode("\r\n",$mailList);
        foreach ($mailListArray as $key => $value) {
            if ($value) {
               MailList::insert(['mail_id'=>$id,'mail_name'=> $value]);
            }
        }
    }
    public function getMailById($id)
    {
        $mail =Mail::where('id',$id)->with('list')->first();
       $list = $mail->list->toArray();
        $mailList ='';
       foreach ($list as $key => $value) {
        if ($mailList =='') {
           $mailList =$value['mail_name'];
           
        }else{
             $mailList =$mailList."\r\n".$value['mail_name'];
        }
       }
       $data =[
        'name'=>$mail->name,
        'description'=>$mail->description,
        'list'=>$mailList,
        'id'=>$id,
       ];
         return response()->json(array(
                'success' => 1,
                'status_code' => 200,
                'data' => $data
            ));
    }
    public function removeMail(Request $request)
    {
        $data =$request->all();
        Mail::where('id',$data['id'])->delete();
        MailList::where('mail_id',$data['id'])->delete();
        return redirect()->back()->with('message', 'Mail Удален');

    }
}
