<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class UserC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::latest();

        if(!empty($request->get('keyword')))
        {
            $users = $users->where('name','like','%'.$request->get('keyword').'%');
            $users = $users->orWhere('email','like','%'.$request->get('keyword').'%');
        }

        $users = $users->paginate(10);
        return view('admin.pages.user.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:5'
        ]);

        if($val->passes())
        {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->save();

            $message = 'Thêm người dùng thành công';

            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => $message
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
        $user = User::find($id);
        if($user == null)
        {
            $message ='Không tìm thấy người dùng';
            session()->flash('success',$message);
            return redirect()->route('user.index');
        }
        return view('admin.pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if($user == null)
        {
            $message ='Không tìm thấy người dùng';
            session()->flash('error',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
            
        }
        $val = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'phone' => 'required'
            
        ]);

        if($val->passes())
        {

          
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if($request->password != '')
            {
                $user->password = Hash::make($request->password);

            }
            $user->status = $request->status;
            $user->save();

            $message = 'Thêm người dùng thành công';

            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => $message
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
        $user = User::find($id);
        if($user == null)
        {
            $message ='Không tìm thấy người dùng';
            session()->flash('error',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
            
        }

        $user->delete();

        $message ='Xoá người dùng thành công!!';
            session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);

        
    }
}
