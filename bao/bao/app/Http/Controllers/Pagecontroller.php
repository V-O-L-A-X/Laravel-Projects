<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Tintuc; 
use App\Models\Loaitin;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Validation\Rule;



class Pagecontroller extends Controller
{
    function __construct()
    {
        $theloai = Theloai::all();
        view()->share('theloai',$theloai);
    }


    function trangchu(){
        $theloai = Theloai::all();
        return view("frontend.pages.trangchu", compact("theloai"));
    }

    function lienhe()
    {
        return view('frontend.pages.lienhe');
    }



    function get_loaitin($id)
    {
        $loaitin = Loaitin::find($id);
        $tintuc = Tintuc::where("idLoaiTin", $id)->paginate(5);
        return view("frontend.pages.loaitin", compact("loaitin", "tintuc"));
    }

    function get_tintuc($id)
    {
        $tintuc = Tintuc::find($id);
        $tinnoibat = Tintuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = Tintuc::where("idLoaiTin",$tintuc->idLoaiTin)->take(4)->get();
        return view("frontend.pages.tintuc",compact("tintuc",'tinnoibat','tinlienquan'));
    }

    function get_dangnhap()
    {
        return view("frontend.pages.dangnhap");
    }
    function post_dangnhap(Request $req)
    {
        $validate = $req->validate([
            'email' => 'required',
            'password' => 'required|min:3|max:32'
        ],[
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập Mật Khẩu',
            'password.min' => 'Mật khẩu không được nhỏ hơn 2 kí tự',
            'password.max' => 'Mật Khẩu không được lớn hơn 32 kí tự'
        ]);
        if (Auth::attempt(['email' => $validate['email'], 'password' => $validate['password']]))
        {
            return view('frontend.pages.trangchu');
        }
        else
        {
            return back()->with("thongbao", "Đăng nhập thất bại");
        }

    }
    function get_dangxuat()
    {
        Auth::logout();
        return view('frontend.pages.trangchu');
    }

    function postBinhLuan(Request $req, $id)
    {
        $val = $req->validate([
            'noidung' => 'required'
        ],[
            'noidung.required' => 'Bạn chưa nhập bình luận'
        ]);

        $tintuc= Tintuc::find($id);
        $comment = new Comment();
        $comment->idTintuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->noidung = $req->noidung;
        $comment->save();
        return redirect()->route('tintuc',[$id,$tintuc->TieuDeKhongDau]);
    }

    function getNguoiDung()
    {
        $user = Auth::user();
        return view("FrontEnd.Pages.nguoidung", compact("user"));
    }

    function postNguoiDung(Request $req)
    {
         /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        $val = $req->validate([
            'name' => 'required|min:3'
            ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng tối thiểu 3 ký tự'
        ]);
        
        $user->name = $val["name"];
        
        $val = $req->validate([
            'password' => 'required|min:3|max:32',
            'passwordAgain' =>'required|same:password'
            ],[
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu tối đa 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu không khớp'
        ]);

        $user->password = bcrypt($val["password"]);
        $user->save();
        return back()->with("thongbao","Bạn đã cập nhật thành công");
    }

    function get_dangky()
    {
        return view("frontend.pages.dangky");
    }

    function post_dangky(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
            'email.required' => 'Chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email này đã được đăng ký',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            'passwordAgain' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại không khớp'
        ]);
        $user = new User;
        $user->name = $validate["name"];
        $user->email = $validate["email"];
        $user->password = bcrypt($validate['password']);
        $user->quyen=0;
        $user->save();
        return redirect()->route("dangky")->with("thongbao","Chúc mừng bạn đã đăng ký thành công");
    }

    function getGioiThieu()
    {
        return view("frontend.pages.gioithieu");
    }

    function postTimKiem(Request $req)
    {
        $tukhoa = $req->tukhoa;
        $tintuc = Tintuc::where('TieuDe','like',"%"."$tukhoa"."%")
        ->orWhere("TomTat","like","%"."$tukhoa"."%")
        ->orWhere("NoiDung","like","%"."$tukhoa"."%")->take("30")->paginate(5);
        return view("frontend.pages.timkiem",compact("tintuc","tukhoa")); 
    }
  
}
