<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\product;
use App\Models\wishlist;
use App\Models\page;
use App\Models\User;
use App\Mail\ContactEmail;


class FrontC extends Controller
{
    public function index(){
       $product = product::where('is_featured','Yes')
        ->orderBy('id','DESC')
        ->take(8)
        ->where('status',1)
        ->get();

        $data['featuredproducts'] = $product;

        $lastestproduct = product::orderBy('id','DESC')
        ->where('status',1)
        ->take(8)
        ->get();
        $data['lastestproducts']= $lastestproduct;



        return view('frontend.home', $data);
    }

    public function addToWishlist(Request $request)
    {
        if(Auth::check() == false)
        {

            session(['url.intended' => url()->previous()]);

            return response()->json([
                'status' => false 

            ]);

        }

        wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]
        );

        //$wishlist = new wishlist;
        //$wishlist->user_id = Auth::user()->id;
        //$wishlist->product_id = $request->id;
        //$wishlist->save();

        $product = product::where('id',$request->id)->first();
        if($product == null)
        {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Product not found.</div>'
    
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success"><strong>"'.$product->title.'"</strong> added in your wishlist!</div>'

        ]);
    }


    public function page($slug)
    {

        $page = page::where('slug',$slug)->first();
        if($page == null)
        {
            abort(404);
        }
        return view('frontend.page', compact('page'));
    }


    public function sendContactEmail(Request $request)
    {
        $val = Validator::make($request->all(),[
                'name'=> 'required',
                'email'=> 'required|email',
                'subject'=> 'required|min:5'

        ]);

        if($val->passes())
        {
            $mailData = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'mail_subject' => 'Bạn có email từ người dùng'
            ];
            $admin = User::where('id',1)->first();
            Mail::to($admin->email)->send(new ContactEmail($mailData));
            
            session()->flash('success','Mơn đã liên lạc, chúng tôi sẽ phản hồi nhanh nhất có thể.');

            return response()->json([
                'status' => true
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'errors' => $val->errors()
            ]);
        }
    }
}
