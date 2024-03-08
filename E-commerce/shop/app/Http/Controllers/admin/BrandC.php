<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\brand;

class BrandC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $brand = brand::latest();
        if(!empty($req->get('keyword')))
        {
            $brand = $brand->where('name','like','%'.$req->get('keyword').'%');
        }


        $brand = $brand->paginate(10);
        
     
        return view('admin.pages.brand.list',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);

        if($val->passes())
        {
            $category = new brand();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();



            $request->session()->flash('success','Brand added successfully');

            return response()->json([
                'status'=> true,
                'message' => 'Brand added successfully'
            ]);




        }else
        {
            return response()->json([
                'status'=> false,
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
        $brand = brand::find($id);
        if(empty($brand))
        {
            return redirect()->route('brand.index');
        }
        return view("admin.pages.brand.edit", compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = brand::find($id);
        if(empty($brand))
        {
            $brand->session()->flash('error','Brand not found'); 
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Brand not found'
            ]);
        }
        



        $val = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$brand->id.',id'
        ]);

        if($val->passes())
        {
        
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

         


            $request->session()->flash('success','Brand updated successfully');

            return response()->json([
                'status'=> true,
                'message' => 'Brand updated successfully'
            ]);




        }else
        {
            return response()->json([
                'status'=> false,
                'errors' => $val->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $brand = brand::find($id);
        if(empty($brand))
        {
            $request->session()->flash('errors','Data not found!');
            return response([
                'status' => false,
                'notFound' => true

            ]);
            //return redirect()->route('subcat.index');
        }

        $brand->delete();
        $request->session()->flash('success', 'Brand deleted successfully!');


            return response([
                'status' => true,
                'message' => 'Brand deleted successfully!'
             
            ]); 
    }
}
