<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\orderItem;
use App\Models\wishlist;
use App\Models\country;
use App\Models\customerAddress;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;




class AuthC extends Controller
{
    public function login()
    {
        return view('frontend.account.login');

    }

    public function register()
    {
        return view('frontend.account.register');
    }

    public function processRegister(Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        if($val->passes())
        {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            $message = 'You have been registered successfully.';

            session()->flash('success', $message);


            return response()->json([
                'status' => true,               

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

    public function authenticate(Request $request)
    {
        $val = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'

        ]);

        if($val->passes())
        {

            if(Auth::attempt(['email' => $request->email,'password' => $request->password],$request->get('remember')))

            {
                if (session()->has('url.intended'))
                {
                   return redirect(session()->get('url.intended'));

                }
                return redirect()->route('account.profile');

            }

            else
            {
                //session()->flash('error', 'Either email/password is incorrect');
                return redirect()->route('account.login')
                        ->withInput($request->only('email'))
                        ->with('error','Either email/password is incorrect');

            }

        }

        else
        {
            return redirect()->route('account.login')
            ->withErrors($val)
            ->withInput($request->only('email'));
        }


    }

    public function profile()
    {
        $userId = Auth::user()->id;
        $countries = country::orderBy('name','ASC')->get();
        $user = User::where('id',$userId)->first();
        $address = customerAddress::where('user_id',$userId)->first();
        return view('frontend.account.profile',compact('user','countries','address'));
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $val = Validator::make($request->all(),[
            'name' =>'required',
            'email' => 'required|email|unique:users,email,'.$userId.',id',
            'phone' => 'required'
        ]);

        if($val->passes())
        {
            $user = User::find($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            
            session()->flash('success', 'Cập nhật profile thành công');

            return response()->json([
                'status' =>true,
                'message' => 'Cập nhật profile thành công'
            ]);

        }
        else
        {
            return response()->json([
                'status' =>false,
                'errors' => $val->errors()
            ]);
        }
    }

    public function updateAddress(Request $request)
    {
        $userId = Auth::user()->id;
        $val = Validator::make($request->all(),[
            'first_name' => 'required|min:2',
            'email' => 'required|email',
            'country_id' => 'required',
            'address' => 'required|min:5',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required'

        ]);

        if($val->passes())
        {
            //$user = User::find($userId);
            //$user->name = $request->name;
            //$user->email = $request->email;
            //$user->phone = $request->phone;
            //$user->save();

            customerAddress::updateOrCreate(
                ['user_id' => $userId],
                [
                    'user_id' => $userId,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'country_id' => $request->country_id,
                    'address' => $request->address,
                    'apartment' => $request->apartment,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip
                ]
            );
            
            session()->flash('success', 'Cập nhật địa chỉ giao hàng thành công');

            return response()->json([
                'status' =>true,
                'message' => 'Cập nhật địa chỉ giao hàng thành công'
            ]);

        }
        else
        {
            return response()->json([
                'status' =>false,
                'errors' => $val->errors()
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login')
        ->with('success','U successfully logged out!');
    }

    public function orders()
    { 
        $user = Auth::user();

        $orders = order::where('user_id', $user->id)->orderBy('created_at','DESC')->get();
        return view('frontend.account.order', compact('orders'));
    }

    public function orderDetail($id)
    {

        $user = Auth::user();
        $orderItems = orderItem::where('order_id',$id)->get();
        $order = order::where('user_id', $user->id)->where('id',$id)->first();

        return view('frontend.account.order-detail',compact('order','orderItems'));

    }

    public function wishlist()
    {
        $wishlists = wishlist::where('user_id',Auth::user()->id)->with('product')->get();
        return view('frontend.account.wishlist',compact('wishlists'));
    }

    public function removeProductFromWishlist(Request $request)
    {
        $wishlist = wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->first();
        if($wishlist == null)
        {
            session()->flash('error','Product already removed');

            return response()->json([
                'status' => true,
            ]);
        }
        else
        {
           wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->delete();
           session()->flash('success','Product removed successfully');

           return response()->json([
               'status' => true,
           ]);
        }
    }

    public function changePasswordForm()
    {
        return view('frontend.account.change-password');
    }

    public function changePassword(Request $request)
    {
        $val = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|min:3',
            'confirm_password' => 'required|same:new_password'
        ]);

        if($val->passes())
        {
            $user = User::select('id','password')->where('id',Auth::User()->id)->first();
            if(!Hash::check($request->old_password,$user->password))
            {
                session()->flash('error','Mật khẩu cũ không trùng khớp');
                return response()->json([
                    'status' => true
                ]);
            }

            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            session()->flash('success','Cập nhật mật khẩu thành công');
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

    public function forgotPassword()
    {
        return view('frontend.account.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
         $val = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
         ]);

         if($val->fails())
         {
            return redirect()->route('front.forgotPassword')->withInput()->withErrors($val);
         }

         $token = Str::random(60);
         \DB::table('password_reset_tokens')->where('email',$request->email)->delete();
         \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
         ]);


         //send email
         $user = User::where('email',$request->email)->first();

         $formData = [
            'token' => $token,
            'user' => $user,
            'mailSubject' => 'Bạn đã gửi yêu cầu đổi mật khẩu'
         ];


         Mail::to($request->email)->send(new ResetPasswordEmail($formData));


         return redirect()->route('front.forgotPassword')->with('success','Kiểm tra hộp thư của bạn để đổi mật khẩu');
        }

    public function resetPassword($token)
    {
        $tokenExist = \DB::table('password_reset_tokens')->where('token',$token)->first();

        if($tokenExist == null)
        {
            return redirect()->route('front.forgotPassword')->with('error','Invalid request');

        }

        return view('frontend.account.reset-password', compact('token'));
        
    }

    public function processResetPassword(Request $request)
    {
        $token = $request->token;
        $tokenObj = \DB::table('password_reset_tokens')->where('token',$token)->first();

        if($tokenObj == null)
        {
            return redirect()->route('front.forgotPassword')->with('error','Invalid request');

        }

        $user = User::where('email',$tokenObj->email)->first(); 

        $val = Validator::make($request->all(),[
            'new_password' => 'required|min:3',
            'confirm_password' => 'required|same:new_password'
         ]);

         if($val->fails())
         {
            return redirect()->route('front.resetPassword',$token)->withErrors($val);
         }

         User::where('id',$user->id)->update([
            'password' => Hash::make($request->new_password)
         ]);

         \DB::table('password_reset_tokens')->where('email',$user->email)->delete();


         return redirect()->route('account.login')->with('success','Bạn đã đổi mật khẩu thành công!');


    }
}
