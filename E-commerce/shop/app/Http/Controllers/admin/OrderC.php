<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\orderItem;

class OrderC extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $orders = order::latest('orders.created_at')->select('orders.*','users.name','users.email');
        $orders = $orders->leftJoin('users','users.id','orders.user_id');
        if(!empty($req->get('keyword')))
        {
            $orders = $orders->where('users.name','like','%'.$req->get('keyword').'%');
            $orders = $orders->orWhere('users.email','like','%'.$req->get('keyword').'%');
            $orders = $orders->orWhere('orders.id','like','%'.$req->get('keyword').'%');
        }

        $orders = $orders->paginate(10);
        return view('admin.pages.order.list', compact('orders'));
    }
    
    public function detail(string $orderId)
    {
        $order = order::select('orders.*','countries.name as countryName')
                        ->where('orders.id',$orderId)
                        ->leftJoin('countries','countries.id','orders.country_id')
                        ->first();
        $orderItems = orderItem::where('order_id',$orderId)->get();
        return view('admin.pages.order.detail',compact('order','orderItems'));
    }


    public function sendInvoiceEmail(Request $request, $orderId)
    {
        orderEmail($orderId, $request->userType);
        $message = 'Order email sent successfully';
        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    
    }
    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = order::find($id);
        $order->status = $request->status;
        $order->shipped_date = $request->shipped_date;
        $order->save();

        $message = 'Status changed successfully';

        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
