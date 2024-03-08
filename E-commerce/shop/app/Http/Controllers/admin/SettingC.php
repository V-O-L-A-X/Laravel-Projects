<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingC extends Controller
{
    public function changePasswordForm()
    {
        return view('admin.pages.user.change-password');
    }
    public function changePassword(Request $request)
    {
        $val = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|min:3',
            'confirm_password' => 'required|same:new_password'
        ]);

        $id = Auth::guard('admin')->user()->id;

        if($val->passes())
        {
            $admin = User::where('id',$id)->first();
            if(!Hash::check($request->old_password,$admin->password))
            {
                session()->flash('error','Mật khẩu cũ không trùng khớp');
                return response()->json([
                    'status' => true
                ]);
            }

            User::where('id',$id)->update([
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
}
