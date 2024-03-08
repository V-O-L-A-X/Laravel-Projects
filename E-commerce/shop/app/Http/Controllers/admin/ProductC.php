<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;
use App\Models\subcategory;
use App\Models\brand;
use App\Models\product;
use App\Models\productimage;
use App\Models\tempimage;
use App\Models\productRating;
use Illuminate\Support\Facades\File;
use Image;

class ProductC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $product = product::latest();
        if(!empty($req->get('keyword')))
        {
            $product = $product->where('title','like','%'.$req->get('keyword').'%');
        }

        $product = $product->paginate(10);


        return view('admin.pages.product.list',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = category::all();
        $subcat = subcategory::all();
        $brand = brand::all();
        return view("admin.pages.product.create",['category'=>$category,'subcat'=>$subcat,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =[
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No'

        ];
        if(!empty($request->track_qty) && $request->track_qty == 'Yes')
        {
            $rules['qty'] = 'required|numeric';
        }


        $val = Validator::make($request->all(),$rules);

        if($val->passes())
        {
            $product = new product;
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->barcode = $request->barcode;
            $product->sku = $request->sku;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->short_description = $request->short_description;
            $product->related_products = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->shipping_returns = $request->shipping_returns;
            $product->save();


            if(!empty($request->image_array))
            {
                foreach($request->image_array as $temp_image_id)
                {
                    $tempImageInfo = tempimage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);


                    $productImage = new productimage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->Save();

                    $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                    $productImage->image = $imageName;
                    $productImage->save();


                    $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    $destPath = public_path().'/uploads/product/large/'.$imageName;
                    $image = Image::make($sourcePath);
                    $image->resize(1400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $image->save($destPath);

                    
                    $destPath = public_path().'/uploads/product/small/'.$imageName;
                    $image = Image::make($sourcePath);
                    $image->fit(300, 300);
                    $image->save($destPath);
                }
            }

            $request->session()->flash('success','Product added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Product added successfully'

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
    public function edit(string $id, Request $request)
    {
        $category = category::all();
        $subcat = subcategory::all();
        $brand = brand::all();
        $product = product::find($id);
        $productImage = productimage::all();

        $relatedProducts = [];

        if($product->related_products != '')
        {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = product::whereIn('id',$productArray)->get();
        }

        return view('admin.pages.product.edit',compact("category","subcat","brand","product","productImage","relatedProducts"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = product::find($id);

        if(empty($product))
        {
            
            return redirect()->route('product.index')->with('errors','Product not found');
        }

        $rules =[
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'.$product->id.',id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,'.$product->id.',id',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No'

        ];
        if(!empty($request->track_qty) && $request->track_qty == 'Yes')
        {
            $rules['qty'] = 'required|numeric';
        }


        $val = Validator::make($request->all(),$rules);

        if($val->passes())
        {
          
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->barcode = $request->barcode;
            $product->sku = $request->sku;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->short_description = $request->short_description;
            $product->related_products = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->shipping_returns = $request->shipping_returns;
            
            $product->save();

            
            
            

            $request->session()->flash('success','Product updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully'

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
    public function destroy(string $id, Request $request)
    {
        $product = product::find($id);

        if(empty($product))
        {
            $request->session()->flash('error','Product not found');
            return response()->json([
                'status' =>false,
                'notFound' => true

            ]);
        }

        $productImages = productimage::where('product_id',$id)->get();

        if(!empty($productImages))
        {
            foreach ($productImages as $productImage)
            {
                File::delete(public_path('uploads/product/large/'.$productImage->image));
                File::delete(public_path('uploads/product/small/'.$productImage->image));
            }

            productimage::where('product_id',$id)->delete();
        }

        $product->delete();

        $request->session()->flash('success','Product deleted successfully');
            return response()->json([
                'status' =>true,
                'message' => 'Product deleted successfully'

            ]);
        
    }

    public function getProducts(Request $request)
    {
        $tempProduct = [];
        if($request->term != "")
        {
            $products = product::where('title','like','%'.$request->term.'%')->get();

            if($products !=null)
            {
                foreach ($products as $product)
                {
                    $tempProduct[] = array('id' => $product->id, 'text' => $product->title);

                }
            }
        }

        return response()->json([
            'tags' => $tempProduct,
            'status' => true
        ]);


    }

    public function productRating(Request $req)
    {
        $ratings = productRating::select('product_ratings.*','products.title as productTitle')->orderBy('created_at','DESC');
        $ratings = $ratings->leftJoin('products','products.id','product_ratings.product_id');
        if(!empty($req->get('keyword')))
        {
            $ratings = $ratings->where('comment','like','%'.$req->get('keyword').'%')
                                ->orWhere('username','like','%'.$req->get('keyword').'%')
                                ->orWhere('products.title','like','%'.$req->get('keyword').'%');
        }
        $ratings = $ratings->paginate(10);
        return view('admin.pages.product.rating',compact('ratings'));

    }

    public function changeRatingStatus(Request $request)
    {
        $productRating = productRating::find($request->id);
        $productRating->status = $request->status;
        $productRating->save();

        session()->flash('success','Status changed successfully');

        return response()->json([
            
            'status' => true
        ]);
    }
}
