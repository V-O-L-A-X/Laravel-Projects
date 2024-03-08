<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class adminC extends Controller
{
    public function getLogin()
    {
        return view("admin.page.user.login");
    }
    public function postLogin(Request $req)
    {
        $val= $req->validate([
            "email" => "required",
            "password" => "required|min:3|max:32"
        ],[
            "email.required" => "Bạn chưa nhập Email",
            "password.required" => "Bạn chưa nhập mật khẩu",
            "password.min" => "Mật khẩu phải tối thiểu 3 kí tự",
            "email.required" => "Mật khẩu chỉ được tối đa 32 kí tự"
        ]);

        if(Auth::attempt(['email'=> $val["email"],"password"=>$val["password"]]))
        {
            return redirect()->route("theloai.index");
        }
        else
        {
            return redirect("login")->with("thongbao","Đăng nhập không thành công");
        }
    }

        public function getLogout()
        {
            Auth::logout();
            return redirect("login");
        }

        public function getProfileUser()
        {
            $user = Auth::user();
            return view("admin.page.user.sua",compact("user"));
        }

        public function danhsach()
        {
            $user = User::paginate(10); 
            return view("admin.page.user.danhsach", compact("user"));
        }
    
}
