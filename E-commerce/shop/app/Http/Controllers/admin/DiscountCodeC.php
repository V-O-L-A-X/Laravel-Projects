<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class DiscountCodeC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $discountCoupons = coupon::latest();
        if(!empty($req->get('keyword')))
        {
            $discountCoupons = $discountCoupons->where('name','like','%'.$req->get('keyword').'%');
            $discountCoupons = $discountCoupons->orwhere('code','like','%'.$req->get('keyword').'%');
        }


        $discountCoupons = $discountCoupons->paginate(10);
        return view('admin.pages.coupon.list',compact('discountCoupons')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        return view('admin.pages.coupon.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(),[
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required'

        ]); 

        if($val->passes())
        {

            if(!empty($request->start_at))
            {
                $now = Carbon::now();
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_at);

                if($startAt->lte($now) == true)
                {
                    return response()->json([
                        'status' => false,
                        'errors' => ['start_at' => 'Start date can not be less than current date']
                    ]);

                }
            }


            if(!empty($request->start_at) && !empty($request->expires_at))
            {
                $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_at);

                if($expiresAt->gt($startAt) == false)
                {
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'Expiry date must be greater than start date']
                    ]);

                }
            }

            $discountCode = new coupon();
            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->start_at = $request->start_at;
            $discountCode->expires_at = $request->expires_at;
            $discountCode->save();
            $message = 'Coupon added successfully';
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
    public function edit(Request $request, string $id)
    {
        $coupons = coupon::find($id);
        if(empty($coupons))

        { 
            session()->flash('error','Data not found');
            return redirect()->route('coupons.index');
        }
        return view("admin.pages.coupon.edit", compact("coupons"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $discountCode = coupon::find($id);

        if($discountCode == null)
        {
            session()->flash('error', 'Data not found');
            return response()->json([
                'status' => true
            ]);
        }
        $val = Validator::make($request->all(),[
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required'

        ]); 

        if($val->passes())
        {

           


            if(!empty($request->start_at) && !empty($request->expires_at))
            {
                $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_at);

                if($expiresAt->gt($startAt) == false)
                {
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'Expiry date must be greater than start date']
                    ]);

                }
            }

           
            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->start_at = $request->start_at;
            $discountCode->expires_at = $request->expires_at;
            $discountCode->save();
            $message = 'Coupon updated successfully';
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
    public function destroy(Request $request, string $id)
    {
        $discountCode = coupon::find($id);

        if($discountCode == null)
        {
            session()->flash('error', 'Data not found');
            return response()->json([
                'status' => true
            ]);
        }
        $discountCode->delete();

        session()->flash('success', 'Coupon deleted successfully');
            return response()->json([
                'status' => true
            ]);
    }
}
