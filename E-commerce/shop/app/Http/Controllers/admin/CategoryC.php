<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;
use App\Models\tempimage;
use Illuminate\Support\Facades\File;
use Image;


class CategoryC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {

        $categoryL = category::latest();
        if(!empty($req->get('keyword')))
        {
            $categoryL = $categoryL->where('name','like','%'.$req->get('keyword').'%');
        }


        $categoryL = $categoryL->paginate(10);
        
     
        return view('admin.pages.category.list',compact('categoryL'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $val = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        if($val->passes())
        {
            $category = new category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            if(!empty($request->image_id))
            {
                $ti= tempimage::find($request->image_id);
                $extArray  = explode('.',$ti->name);
                $ext = last($extArray);
                
                $newImageName = $category->id.'.'.$ext;
                $sPath = public_path().'/temp/'.$ti->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;

                File::copy($sPath,$dPath);

                $dPath = public_path().'/uploads/category/thumb/'.$newImageName;

                $img = Image::make($sPath);
                //$img->resize(450, 600);

                $img->fit(450, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();
            }


            $request->session()->flash('success','Category added successfully');

            return response()->json([
                'status'=> true,
                'message' => 'Category added successfully'
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
        $category = category::find($id);
        if(empty($category))
        { 
            return redirect()->route('category.index');
        }
        return view("admin.pages.category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $category = category::find($id);
        if(empty($category))
        {
            $category->session()->flash('error','Category not found'); 
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }
        



        $val = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id'
        ]);

        if($val->passes())
        {
        
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            $oldImage = $category->image;

            if(!empty($request->image_id))
            {
                $ti= tempimage::find($request->image_id);
                $extArray  = explode('.',$ti->name);
                $ext = last($extArray);
                
                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$ti->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;

                File::copy($sPath,$dPath);

                $dPath = public_path().'/uploads/category/thumb/'.$newImageName;

                $img = Image::make($sPath);
                //$img->resize(450, 600);

                $img->fit(450, 600, function ($constraint) {
                    $constraint->upsize();
                });

                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();

                File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/category/'.$oldImage);
            }


            $request->session()->flash('success','Category updated successfully');

            return response()->json([
                'status'=> true,
                'message' => 'Category updated successfully'
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
        $category = category::find($id);
        if(empty($category))
        {

            $category->session()->flash('error','Category not found');
            return response()->json([
                'status'=> true,
                'message' => 'Category not found'
            ]); 
        }

        File::delete(public_path().'/uploads/category/thumb/'.$category->image);
        File::delete(public_path().'/uploads/category/'.$category->image);

        $category->delete();

        $request->session()->flash('success','Category deleted successfully');
        

        return response()->json([
            'status'=> true,
            'message' => 'Category deleted successfully'
        ]);
    }



}
