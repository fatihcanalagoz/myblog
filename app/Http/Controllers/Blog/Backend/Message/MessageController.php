<?php

namespace App\Http\Controllers\Blog\Backend\Message;

use App\Models\Blog\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index (){
        $messages = Contact::orderBy('created_at' ,'DESC')->get();
        return view('blog.admin.messages.index',compact('messages'));
       }
    //Message Delete

    public function messageDelete($id){
        Contact::findOrFail($id)->delete();
        toastr()->success('Mesaj başarıyla silindi','Başarılı');
        return redirect()->route('admin.message');

    }

    public function messageRead($id){
        $messages = Contact::whereId($id)->get();

        return view('blog.admin.messages.show',compact('messages'));
    }
   
}
