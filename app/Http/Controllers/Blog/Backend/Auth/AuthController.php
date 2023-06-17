<?php

namespace App\Http\Controllers\Blog\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(){
        return $this->middleware('isAdmin' ,['except' => ['index','login']]);
    }
   public function index(){
    return view('blog.admin.auth.login');
   }

   public function login(Request $request){
   
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        toastr()->info('Merhabalar, '. Auth::user()->name);
        return redirect()->route('admin.dashboard');
    } 
   
    return redirect()->route('admin.login')->withErrors('Email veya Şifre hatalı.');
   }
   public function logout(){
    Auth::logout();
    toastr()->success('Yine Bekleriz..' ,'Güle Güle ');
    return redirect()->route('admin.login');
   }
}
