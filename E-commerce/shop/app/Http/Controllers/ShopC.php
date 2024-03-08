<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use App\Models\brand;
use App\Models\product;
use App\Models\productRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ShopC extends Controller
{
    public function index(Request $request, $categorySlug=null, $subCategorySlug=null)
    {

        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        $cat = category::orderBy('name','ASC')
        ->with('subcat')
        ->where('status',1)
        ->get();

        $brand = brand::orderBy('name','ASC')
        ->where('status',1)
        ->get();

        $product = product::where('status',1);

      //filter product here

        if(!empty($categorySlug))
        {
            $category = category::where('slug',$categorySlug)->first();
            $product = $product->where('category_id',$category->id);

            $categorySelected = $category->id;
        }
        if(!empty($subCategorySlug))
        {
            $subCategory = subcategory::where('slug',$subCategorySlug)->first();
            $product = $product->where('sub_category_id',$subCategory->id);
            $subCategorySelected = $subCategory->id;

        }

        if(!empty($request->get('brand')))
        {
            $brandsArray = explode(',',$request->get('brand'));
            $product = $product->whereIn('brand_id',$brandsArray);
        }

        if($request->get('price_max') != '' && $request->get('price_min') != '')
        {
            if($request->get('price_max') == 1000000 )
            {
                $product = $product->whereBetween('price',[intval($request->get('price_min')),1000000]);

            }
            else{
                $product = $product->whereBetween('price',[intval($request->get('price_min')),intval($request->get('price_max'))]);

            }
            

        }


        if(!empty($request->get('search')))
        {
            $product = $product->where('title','like','%'.$request->get('search').'%');

        }

        

        
        if($request->get('sort') != '')
        {
            if($request->get('sort') == 'latest')
            {
                $product = $product->orderBy('id','DESC');

            }
            else if($request->get('sort') == 'price_asc')
            {
                $product = $product->orderBy('price','ASC');

            }
            else
            {
                $product = $product->orderBy('price','DESC');

            }
        }
        else
        {
            $product = $product->orderBy('id','DESC');
        }


        $product = $product->paginate(6);

        $data['cat'] = $cat;
        $data['brand'] = $brand;
        $data['product'] = $product;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandsArray'] = $brandsArray;
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        $data['sort'] = $request->get('sort');

        return view('frontend.shop',$data);
    }

    public function product($slug)
    {
        $product = product::where('slug',$slug)
        ->with('productimage','productrating')
        ->withCount('productrating')
        ->withSum('productrating','rating')
        ->first();

        if($product == null)
        {
             abort(404);
        }

        //dd($product);


        $relatedProducts = [];

        if($product->related_products != '')
        {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = product::whereIn('id',$productArray)->where('status',1)->with('productimage')->get();
        }

        $data['product'] = $product;
        $data['relatedProducts'] = $relatedProducts;
        
        //Rating Calculating

        //"productrating_count" => 2
        //"productrating_sum_rating" => 9.0
        $avgRating = '0.00';
        $avgRatingPer = 0;

        if($product->productrating_count > 0)
        {
            $avgRating = number_format(($product->productrating_sum_rating/$product->productrating_count),2);

            $avgRatingPer = ($avgRating*100)/5;
        }

        $data['avgRating'] = $avgRating;
        $data['avgRatingPer'] = $avgRatingPer;


        return view('frontend.product',$data);

    }

    public function saveRating($id, Request $request)
    {
        $val = Validator::make($request->all(),[
            'name' => 'required|min:5',
            'email' => 'required|email',
            'rating' => 'required'
        ]);

        if($val->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $val->errors()
            ]);
        }
        
        $count = productRating::where('email',$request->email)->count();

        if($count >0)
        {
            session()->flash('error','Bạn đã đánh giá sản phẩm này');

            return response()->json([
                'status' => true,
               
            ]);
        }

        $productRating = new productRating;
        $productRating->product_id = $id;
        $productRating->username = $request->name;
        $productRating->email = $request->email;
        $productRating->comment = $request->comment;
        $productRating->rating = $request->rating;
        $productRating->status = 0;
        $productRating->save();


        session()->flash('success','Cảm ơn đánh giá của bạn');

        return response()->json([
            'status' => true,
            'message' => 'Cảm ơn đánh giá của bạn'
        ]);

        
    }
}
