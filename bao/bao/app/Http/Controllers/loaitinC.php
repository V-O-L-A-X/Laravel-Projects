<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\tenkhongdau;
use App\Models\Theloai;
use App\Models\Loaitin;
use Illuminate\Validation\Rule;


class loaitinC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loaitin = Loaitin::all(); 
        return view("admin.page.loaitin.danhsach", compact("loaitin"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.page.loaitin.them");
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $val = $req->validate([
            "ten" => 'required|min:3|max:100|unique:LoaiTin,Ten',
            "theloai" => "required"

            ],[
            "ten.required" => "Bạn chưa nhập tên loạitin",
            "ten.min" => "Tên loại tin tối thiểu 3 ký tự",
            "ten.max" => "Tên loại tin tối đa 100 ký tự",
            "ten.unique" => "Tên loại tin đã có trong CSDL",
            "theloai.required" =>"Bạn chưa chọn thể loại"
            ]);
            $loaitin = new Loaitin();
            $loaitin->Ten = $val["ten"];
            $loaitin->TenKhongDau = (new tenkhongdau)->changeTitle($val['ten']);
            $loaitin->idTheLoai = $val["theloai"];
            $loaitin->save();
            return redirect("admin/loaitin/create")->with("thongbao", "Thêm mới thàng công");
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
        $loaitin = Loaitin::find($id);
        $theloai = Theloai::all();
        return view("admin.page.loaitin.sua", compact("theloai","loaitin"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $val = $req->validate([
            //"ten" => 'required|min:3|max:100|unique:LoaiTin,Ten',
            'ten' => ['required','min:3', 'max:100', Rule::unique('loaitin')->ignore($id)],
            "theloai" => "required"
            ],[
            "ten.required" => "Bạn chưa nhập tên loại tin",
            "ten.min" => "Tên loại tin tối thiểu 3 ký tự",
            "ten.max" => "Tên loại tin tối đa 100 ký tự",
            "ten.unique" => "Tên loại tin đã có trong CSDL",
            "theloai.required" => "Bạn chưa chọn thể loại"
            ]);
            $loaitin = Loaitin::find($id);
            $loaitin->Ten = $val['ten'];
            $loaitin->TenKhongDau =(new tenkhongdau)->changeTitle($val['ten']);
            $loaitin->idTheLoai = $val["theloai"];
            $loaitin->save();
            return redirect("admin/loaitin/$id/edit")->with("thongbao","Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tl = Loaitin::find($id);
        $tl->delete();
        return redirect("admin/loaitin")->with("thongbao", "Xoá loại tin thành công");
    }

    
}
