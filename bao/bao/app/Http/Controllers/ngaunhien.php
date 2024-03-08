<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Loaitin;
use App\Models\Tintuc;

class ngaunhien extends Controller
{
    public function getLoaiTin($idtl)
    {
        $loaitin = Loaitin::where("idTheLoai", $idtl)->get();
        foreach($loaitin as $lt)
        {
            echo "<option value='" .$lt->id."'>".$lt->Ten."</option>";
        }
    }
}
