<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\tenkhongdau;



 

class theloaiC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $theloai = Theloai::all();
        return view("admin.page.theloai.danhsach", compact("theloai"));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.page.theloai.them");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $val = $req->validate([
            "ten" => 'required|min:3|max:100|unique:TheLoai,Ten'
            ],[
            "ten.required" => "Bạn chưa nhập tên thể loại",
            "ten.min" => "Tên thể loại tối thiểu 3 ký tự",
            "ten.max" => "Tên thể loại tối đa 100 ký tự",
            "ten.unique" => "Tên thể đã có trong CSDL"
            ]);
            $theloai = new Theloai();
            $theloai->Ten = $val["ten"];
            $theloai->TenKhongDau = (new tenkhongdau)->changeTitle($val['ten']);
            $theloai->save();
            return redirect("admin/theloai/create")->with("thongbao", "Thêm mới thàng công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $theloai = Theloai::find($id);
        return view("admin.page.theloai.sua", compact("theloai"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $val = $req->validate([
            "ten" => 'required|min:3|max:100|unique:TheLoai,Ten'
            ],[
            "ten.required" => "Bạn chưa nhập tên thể loại",
            "ten.min" => "Tên thể loại tối thiểu 3 ký tự",
            "ten.max" => "Tên thể loại tối đa 100 ký tự",
            "ten.unique" => "Tên thể đã có trong CSDL"
            ]);
            $theloai = Theloai::find($id);
            $theloai->Ten = $val['ten'];
            $theloai->TenKhongDau =(new tenkhongdau)->changeTitle($val['ten']);
            $theloai->save();
            return redirect("admin/theloai/$id/edit")->with("thongbao","Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tl = Theloai::find($id);
        $tl->delete();
        return redirect("admin/theloai")->with("thongbao", "Xoá thể loại thành công");
    }

    
}
