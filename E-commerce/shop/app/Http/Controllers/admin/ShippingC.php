<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\country;
use App\Models\shipping;
use Illuminate\Support\Facades\Validator;


class ShippingC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries =  country::get();
        $shippingCharges = shipping::all();

    
        return view('admin.pages.shipping.create',compact('countries','shippingCharges'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $val = Validator::make($request->all(),[
            'country' => 'required',
            'amount' => 'required|numeric'
        ]);

        if($val->passes())
        {

            $count = shipping::where('country_id',$request->country)->count();
            if($count > 0)
            {
                session()->flash('error','Shipping already added.');

                return response()->json([
                    'status' => true,
                ]);
        }
            $shipping = new shipping;
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success','Shipping added successfully.');

            return response()->json([
                'status' => true,
               
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
        $countries =  country::get();
        $shippingCharges = shipping::find($id);
        return view('admin.pages.shipping.edit',compact('countries','shippingCharges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shipping = shipping::find($id);
        $val = Validator::make($request->all(),[
            'country' => 'required',
            'amount' => 'required|numeric'
        ]);

        if($val->passes())
        {
            if($shipping == null)
            {
                session()->flash('error','Shipping not found.');

                return response()->json([
                    'status' => true,
                
                ]);

            }

            
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success','Shipping updated successfully.');

            return response()->json([
                'status' => true,
               
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
    public function destroy(string $id)
    {
        $shippingCharges =shipping::find($id);
        $shippingCharges->delete();

        if($shippingCharges == null)
        {
            session()->flash('error','Shipping not found.');

            return response()->json([
                'status' => true,
            
            ]);

        }

        session()->flash('success','Shipping deleted successfully.');

        return response()->json([
            'status' => true,
           
        ]);
    }
}
