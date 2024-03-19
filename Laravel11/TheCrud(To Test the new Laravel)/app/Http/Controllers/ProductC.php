<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ProductC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'image'
            

        ]);

        if($val->passes())
        {
            $product = new Product();
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();

            if($request->image !="")
            {
                //Store Image

                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time().'.'.$ext; //Unique Image name


                //Image to dictionary
                $image->move(public_path('Image/Product'),$imageName);


                //Store Image name to database
                $product->image = $imageName;
                $product->save();
            }

            return redirect()->route('product.index')->with('success','Product added successfully');
        }
        else
        {
            return redirect()->route('product.create')->withInput()->withErrors($val);
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
        $p=Product::findOrFail($id);
        return view('product.edit',compact('p'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product =Product::findOrFail($id);
        $val = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'image'
            

        ]);

        if($val->passes())
        {
           
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();

            if($request->image !="")
            {
                //Delete old Image

                File::delete(public_path('Image/Product/'.$product->image));
                
                //Store Image

                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time().'.'.$ext; //Unique Image name


                //Image to dictionary
                $image->move(public_path('Image/Product'),$imageName);


                //Store Image name to database
                $product->image = $imageName;
                $product->save();
            }

            return redirect()->route('product.index')->with('success','Product updated successfully');
        }
        else
        {
            return redirect()->route('product.edit',$product->id)->withInput()->withErrors($val);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $p=Product::findOrFail($id);

        File::delete(public_path('Image/Product/'.$p->image));

        $p->delete();

        return redirect()->route('product.index')->with('success','Product deleted successfully');


    }
}
