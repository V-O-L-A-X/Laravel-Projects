<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PageC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $pages = page::latest();
        if(!empty($req->get('keyword')))
        {
            $pages = $pages->where('name','like','%'.$req->get('keyword').'%');
            $pages = $pages->orWhere('content','like','%'.$req->get('keyword').'%');
        }


        $pages = $pages->paginate(10);
        
     
        return view('admin.pages.page.list',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' => 'required'
        ]);


        if($val->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $val->errors()
            ]);
        }

        $page = new page;
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();

        $message = 'Trang thêm thành công';
        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'errors' => $message
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = page::find($id);
        if(empty($page))
        {
            session()->flash('error','Không tìm thấy trang');
            return redirect()->route('page.index');
        }
        return view("admin.pages.page.edit", compact("page"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $page = page::find($id);

        if($page == null)
        {
            session()->flash('error','Không tìm thấy trang ');

            return response()->json([
                'status' => true
                
            ]);
        }
        $val = Validator::make($request->all(),[
            'name' => 'required'
        ]);


        if($val->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $val->errors()
            ]);
        }

        
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();

        $message = 'Trang cập nhật thành công';
        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'errors' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = page::find($id);
        if(empty($page))
        {
            session()->flash('errors','Data not found!');
            return response([
                'status' => false,
                'notFound' => true

            ]);
            //return redirect()->route('subcat.index');
        }

        $page->delete();
        session()->flash('success', 'Page deleted successfully!');


            return response([
                'status' => true,
                'message' => 'P age deleted successfully!'
             
            ]); 
    }
}
