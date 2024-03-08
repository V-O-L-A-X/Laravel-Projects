<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\tenkhongdau;
use App\Models\Theloai;
use App\Models\Loaitin; 
use App\Models\Tintuc;
use Illuminate\Validation\Rule;
use File;


class tintucC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tintuc = Tintuc::orderBy("id","DESC")->paginate(10);
        return view("admin.page.tintuc.danhsach", compact("tintuc"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theloai = Theloai::all();
        $loaitin = Loaitin::all();
        return view("admin.page.tintuc.them",['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }



 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $val= $req->validate([
            "theloai" =>'required',
            "loaitin"=>'required',
            "tieude" => 'required|min:3|unique:TinTuc,TieuDe',
            "tomtat" => "required",
            "noidung" => "required"

            ],[
            "theloai.required" => "Ban chưa chọn thể loại",
            "loaitin.required" => "Bạn chưa chọn loại tin",
            "tieude.required" => "Bạn chưa nhập tiêu đề",
            "tieude.min" => "Tên tin tức phải tối thiểu 3 ký tự",
            "tieude.unique" => "Tiêu đề đã tồn tại",
            "tomtat.required" => "Bạn chưa nhập tóm tắt",
            "noidung.required" =>"Bạn chưa nhập nội dung"
            ]);
            $tintuc = new Tintuc();
            $tintuc->Tieude = $val["tieude"];
            $tintuc->TieuDeKhongDau = (new tenkhongdau)->changeTitle($val["tieude"]);
            $tintuc->idLoaiTin = $val["loaitin"];
            $tintuc->TomTat = $val["tomtat"];
            $tintuc->NoiDung = $val["noidung"];
            $tintuc->SoLuotXem = 0;

            if($req->hasFile('hinh'))
            {
                $file = $req->file('hinh');
                $duoi = $file->getClientOriginalExtension();
                if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg' && $duoi !='gif')
                {
                    return redirect()->route("tintuc.create")->with('loi','Bạn chỉ được chọn file có đuôi jpg, png, jpeg hoặc gif');
                }
                $name = $file->getClientOriginalName();
                $hinh = Str::random(4)."_".$name;
                while(file_exists("images/".$hinh))
                {
                    $hinh = Str::random(4)."_".$name;
                }
                $file->move("images",$hinh);
                $tintuc->Hinh=$hinh;
            }
            else{
                $tintuc->Hinh= "";
            }
            $tintuc->save();
            return redirect("admin/tintuc/create")->with("thongbao", "Thêm tin thàng công");
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
        $loaitin = Loaitin::all();
        $tintuc = Tintuc::find($id);
        $theloai = Theloai::all();
        return view("admin.page.tintuc.sua", compact("theloai","loaitin","tintuc"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $tintuc = Tintuc::find($id);
        $val = $req->validate([
            "theloai" => "required",
            "loaitin" => "required",
            //"tieude" => "required|min:3|unique:TinTuc,TieuDe",
            'tieude' => ['required','min:3', Rule::unique('tintuc')->ignore($id)],
            "tomtat" => "required",
            "noidung" => "required"

            ],[
            "theloai.required" => "Ban chưa chọn thể loại",
            "loaitin.required" => "Bạn chưa chọn loại tin",
            "tieude.required" => "Bạn chưa nhập tiêu đề",
            "tieude.min" => "Tên tin tức phải tối thiểu 3 ký tự",
            "tieude.unique" => "Tiêu đề đã tồn tại",
            "tomtat.required" => "Bạn chưa nhập tóm tắt",
            "noidung.required" =>"Bạn chưa nhập nội dung"
            ]);
            $tintuc = new Tintuc();
            $tintuc->Tieude = $val["tieude"];
            $tintuc->TieuDeKhongDau = (new tenkhongdau)->changeTitle($val["tieude"]);
            $tintuc->idLoaiTin = $val["loaitin"];
            $tintuc->TomTat = $val["tomtat"];
            $tintuc->NoiDung = $val["noidung"];
            $tintuc->SoLuotXem = 0;
            if($req->hasFile('hinh'))
            {
                $file = $re->file('hinh');
                $duoi = $file->getClientOriginalExtension();
                if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg' && $duoi !='gif')
                {
                    return redirect()->route("tintuc.edit",$tintuc->id)->with('loi','Bạn chỉ được chọn file có đuôi jpg, png, jpeg hoặc gif');
                }
                $name = $file->getClientOriginalName();
                $hinh = Str_random(4)."_".$name;
                while(file_exists("images/".$hinh))
                {
                    $hinh = Str_random(4)."_".$name;
                }
                $file->move("images",$hinh);
                $tintuc->Hinh=$hinh;

            }

            else{
                $tintuc->Hinh= "";
            }
            $tintuc->save();
            return redirect("admin/tintuc/$id/edit")->with("thongbao", "Thêm tin thàng công");

            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tt = Tintuc::find($id);
        $tt->delete();
        return redirect()->route("tintuc.index")->with("thongbao", "Xoá loại tin thành công");
    }

    
}
