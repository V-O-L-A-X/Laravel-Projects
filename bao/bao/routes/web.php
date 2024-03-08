<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\theloaiC;
use App\Http\Controllers\loaitinC;
use App\Http\Controllers\tintucC;
use App\Http\Controllers\adminC;
use App\Http\Controllers\ngaunhien;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('frontend.pages.trangchu');
});



Route::group(["prefix"=>"front"],function(){
    Route::get("trangchu",[Pagecontroller::class,"trangchu"])->name("trangchu");
    Route::get("lienhe",[Pagecontroller::class,"lienhe"])->name("lienhe");

    Route::get("loaitin/{id}",[Pagecontroller::class,"get_loaitin"])->name("loaitin");

    Route::get("tintuc/{id}/{TieuDeKhongDau}.html",[Pagecontroller::class,"get_tintuc"])->name("tintuc");

    Route::get("dangnhap",[Pagecontroller::class,"get_dangnhap"])->name("dangnhap");
    Route::post("dangnhap",[Pagecontroller::class,"post_dangnhap"])->name("dangnhap");
    Route::get("dangxuat",[Pagecontroller::class,"get_dangxuat"])->name("dangxuat");
    Route::post("binhluan/{id}",[Pagecontroller::class,"postBinhLuan"])->name("binhluan");
    Route::get("nguoidung",[Pagecontroller::class,"getNguoiDung"])->name("nguoidung");
    Route::post("nguoidung",[Pagecontroller::class,"postNguoiDung"])->name("nguoidung");

    Route::get("dangky",[Pagecontroller::class,"get_dangky"])->name("dangky");
    Route::post("dangky",[Pagecontroller::class,"post_dangky"])->name("xulydangky");
    Route::get("gioithieu",[Pagecontroller::class,"getGioiThieu"])->name("gioithieu");

    Route::post("timkiem",[Pagecontroller::class,"postTimKiem"])->name("timkiem");



});

Route::group(["prefix" => "admin","middleware" => "AdminLogin"],function(){
    Route::resource('theloai',theloaiC::class);
    Route::resource('loaitin',loaitinC::class);
    Route::resource('tintuc',tintucC::class);
    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idtl}',[ngaunhien::class,"getLoaiTin"]);
    });
    
});

Route::get("login",[adminC::class,"getLogin"])->name("login");
Route::post("login",[adminC::class,"postLogin"])->name("login");
Route::get("logout",[adminC::class,"getLogout"])->name("logout");
Route::get("profileuser",[adminC::class,"getProfileUser"])->name("profile");
Route::get("user",[adminC::class,"danhsach"])->name("danhsach");









