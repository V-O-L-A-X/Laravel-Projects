<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\subcategory;
use App\Models\category;

use Illuminate\Support\Facades\File;



class SubCategoryC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        
        $subcatL = subcategory::select('sub_categories.*','categories.name as categoryName')
        ->latest('sub_categories.id')
        ->leftJoin('categories','categories.id','sub_categories.category_id');
        if(!empty($req->get('keyword')))
        {
            $subcatL = $subcatL->where('sub_categories.name','like','%'.$req->get('keyword').'%');
            $subcatL = $subcatL->orWhere('categories.name','like','%'.$req->get('keyword').'%');
        }


        $subcatL = $subcatL->paginate(10);
        
     
        return view('admin.pages.subcat.list',compact('subcatL'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcat = category::orderBy('name','ASC')->get();
        $data['subcat'] = $subcat;
        return view('admin.pages.subcat.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' =>  'required',
            'slug' => 'required|unique:sub_categories',
            'category' => 'required',
            'status' => 'required'

        ]);

        if($val->passes())
        {
            $subcat = new subcategory();
            $subcat->name = $request->name;
            $subcat->slug = $request->slug;
            $subcat->status = $request->status;
            $subcat->showHome = $request->showHome;
            $subcat->category_id = $request->category;
            $subcat->save();

            $request->session()->flash('success', 'Sub Category added successfully!');


            return response([
                'status' => true,
                'message' => 'Sub Category added successfully!'
             
            ]); 

        }
        else
        {
            return response([
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
    public function edit(string $id, Request $request)
    {
        $subcat = subcategory::find($id);
        if(empty($subcat))
        {
            $request->session()->flash('errors','Data not found!');
            return redirect()->route('subcat.index');
        }

        $cat = category::orderBy('name','ASC')->get();
        $data['cat'] = $cat;
        $data['subcat'] = $subcat;
        return view('admin.pages.subcat.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $subcat = subcategory::find($id);
        if(empty($subcat))
        {
            $request->session()->flash('errors','Data not found!');
            return response([
                'status' => false,
                'notFound' => true

            ]);
            //return redirect()->route('subcat.index');
        }


        $val = Validator::make($request->all(),[
            'name' =>  'required',
            'slug' => 'required|unique:sub_categories,slug,'.$subcat->id.',id',
            'category' => 'required',
            'status' => 'required'

        ]);

        if($val->passes())
        {

            $subcat->name = $request->name;
            $subcat->slug = $request->slug;
            $subcat->status = $request->status;
            $subcat->showHome = $request->showHome;
            $subcat->category_id = $request->category;
            $subcat->save();

            $request->session()->flash('success', 'Sub Category updated successfully!');


            return response([
                'status' => true,
                'message' => 'Sub Category updated successfully!'
             
            ]); 

        }
        else
        {
            return response([
                'status' => false,
                'errors' => $val->errors()
            ]);  

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $subcat = subcategory::find($id);
        if(empty($subcat))
        {
            $request->session()->flash('errors','Data not found!');
            return response([
                'status' => false,
                'notFound' => true

            ]);
            //return redirect()->route('subcat.index');
        }

        $subcat->delete();
        $request->session()->flash('success', 'Sub Category deleted successfully!');


            return response([
                'status' => true,
                'message' => 'Sub Category deleted successfully!'
             
            ]); 
    }
}
