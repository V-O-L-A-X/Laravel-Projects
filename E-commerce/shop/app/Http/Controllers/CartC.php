<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\country;
use App\Models\customerAddress;
use App\Models\order;
use App\Models\orderItem;
use App\Models\shipping;
use App\Models\coupon;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class CartC extends Controller
{
    public function addToCart(Request $request)
    {
        $product = product::with('productimage')->find($request->id);

        if($product == null)
        {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'

            ]);
        }

        if(Cart::count() > 0)
        {
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach($cartContent as $item)
            {
                if($item->id == $product->id)
                {
                    $productAlreadyExist = true;
                }
            }

            if($productAlreadyExist == false)
            {
                Cart::add($product->id, $product->title, 1, $product->price,['productImage' => (!empty($product->productimage)) ? $product->productimage->first() : '']);
                $status = true;
                $message = '<strong>'.$product->title.'</strong> added in cart successfully';
                session()->flash('success',$message);
            }
            else
            {
                $status = false;
                $message = $product->title.'already added in cart';
            }

        }
        else
        {
            Cart::add($product->id, $product->title, 1, $product->price,['productImage' => (!empty($product->productimage)) ? $product->productimage->first() : '']);
            $status = true;
            $message = '<strong>'.$product->title.'</strong> added in cart successfully';
            session()->flash('success',$message);
            
        }
        return response()->json([
            'status' => $status,
            'message' => $message

        ]);
        //Cart::add('293ad', 'Product 1', 1, 9.99);

    }

    public function cart()
    {
        $cartContent = Cart::content();
        //dd($cartContent);
        $data['cartContent'] = $cartContent;
        return view('frontend.cart',$data);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = product::find($itemInfo->id);

        if($product->track_qty == 'Yes')
        {
            if($qty <= $product->qty)
            {
                Cart::update($rowId,$qty);
                $message = 'Cart updated successfully';
                $status = true;
                session()->flash('success',$message);
            }
            else
            {
                $message = 'Request qty('.$qty.') not available in stock';
                $status = false;
                session()->flash('error',$message);
            }
        }
        else
        {
            Cart::update($rowId,$qty);
            $message = 'Cart updated successfully';
            $status = true;
            session()->flash('success',$message);
        }

        



        

        

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }
     

    public function deleteItem(Request $request)
    {

        $itemInfo = Cart::get($request->rowId);

        if($itemInfo == null)

        {
            $messageE= 'item not found in cart';
            session()->flash('error',$messageE);
            return response()->json([
                'status' => false,
                'message' => $messageE
            ]);

        }

        Cart::remove($request->rowId);

        $message = 'Item remove from cart successfully';
        session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);


        
    }

    public function checkout()
    {
        $discount=0;
        if(Cart::count() == 0)
        {
            return redirect()->route('front.cart');
        }

        if(Auth::check() == false)
        {
            if (!session()->has('url.intended'))
            {
                session(['url.intended' => url()->current()]);

            }

            
            return redirect()->route('account.login');
        }

        $customerAddress = customerAddress::where('user_id',Auth::user()->id)->first();

        session()->forget('url.intended');



        $countries = country::orderBy('name','ASC')->get();

        $subTotal = Cart::subtotal(2,'.','');
        //apply discount

        if(session()->has('code'))
        {
            
            $code = session()->get('code');
            if($code->type == 'percent')
            {
                $discount = ($code->discount_amount/100)*$subTotal;

            }
            else
            {
                $discount = $code->discount_amount;
            }
        }



        if($customerAddress != '')
        {
            $userCountry = $customerAddress->country_id;

            $shippingInfo = shipping::where('country_id', $userCountry)->first();
    
            $totalQty = 0;
            $totalShippingCharge = 0;
            $grandTotal = 0;
    
            foreach (Cart::content() as $item)
            {
                $totalQty += $item->qty;
    
            }

            if($shippingInfo !=null)
            {
                $totalShippingCharge = $totalQty*$shippingInfo->amount;
            }
        
                $grandTotal = ($subTotal-$discount)+$totalShippingCharge;
            }
            else
            {
                $grandTotal = ($subTotal-$discount);
                $totalShippingCharge = 0;
            }

        

        return view('frontend.checkout',compact('countries','customerAddress','totalShippingCharge','grandTotal','discount'));
    }

    public function processCheckout(Request $request)
    {
        $val = Validator::make($request->all(),[
            'first_name' => 'required|min:2',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required|min:5',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required'

        ]);

        if($val->fails())

        {
            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'errors' => $val->errors()
            ]);
        }


        $user = Auth::user();
        customerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip
            ]
        );

        if($request->payment_method == 'cod')
        {
            $discountCodeId=NULL;
            $promoCode='';
            $shipping = 0;
            $discount = 0;
            $subTotal = Cart::subtotal(2,'.','');

            if(session()->has('code'))
            {
                $code = session()->get('code');
                if($code->type == 'percent')
                {
                    $discount = ($code->discount_amount/100)*$subTotal;    
                }
                else
                {
                    $discount = $code->discount_amount;
                }
                $discountCodeId  = $code->id;
                $promoCode = $code->code;
               
            }

           

            $shippingInfo = shipping::where('country_id',$request->country)->first();

            $totalQty = 0;
          

            foreach (Cart::content() as $item)
            {
                $totalQty += $item->qty;

            }

            if($shippingInfo !=null)
            {
                $shipping = $shippingInfo->amount;
                $grandTotal = ($subTotal-$discount) + $shipping;

            }
            else
            {
                $shippingInfo = shipping::where('country_id','rest_of_world')->first();

                
                    $shipping = $shippingInfo->amount;
                    $grandTotal = ($subTotal-$discount) + $shipping;
                

            }

            



            

            $order = new order;
            $order->subtotal = $subTotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->discount = $discount;
            $order->coupon_code_id = $discountCodeId;
            $order->coupon_code = $promoCode;


            $order->payment_status = 'not paid';
            $order->status = 'pending';
            $order->coupon_code = $promoCode;


            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            $order->state = $request->state;
            $order->city = $request->city;
            $order->zip = $request->zip;
            $order->notes = $request->order_notes;
            $order->country_id = $request->country;
            $order->save();


            
            foreach(Cart::content() as $item)
            {
                $orderItem = new orderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price*$item->qty;
                $orderItem->save();


                $productData = product::find($item->id);
                if($productData->track_qty == 'Yes')
                {
                    $currentQty = $productData->qty;
                    $updateQty = $currentQty-$item->qty;
                    $productData->qty = $updateQty;
                    $productData->save();
    
                }
                
            }

            orderEmail($order->id,'customer');

            session()->flash('success','You have successfully palace your order');

            Cart::destroy();

            session()->forget('code');

            return response()->json([
                'message' => 'Order saved successfully',
                'orderId' => $order->id,
                'status' => true
            ]);

            

        }
        else
        {

        }



    }

    public function thankyou($id)
    {
        return view('frontend.thanks', compact('id'));
    }

    public function getOrderSummary(Request $request)
    {
        $subTotal = Cart::subtotal(2,'.','');
        $discount = 0;
        $discountString = '';

        if(session()->has('code'))
        {
            $code = session()->get('code');
            if($code->type == 'percent')
            {
                $discount = ($code->discount_amount/100)*$subTotal;

            }
            else
            {
                $discount = $code->discount_amount;
            }
            $discountString = '<div class="mt-4" id="discount-response">
            <strong>'.session()->get('code')->code.'</strong>
            <a class="btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
        </div>';
        }

        



        if($request->country_id >0)
        {

            
            $shippingInfo = shipping::where('country_id',$request->country_id)->first();

            $totalQty = 0;
          

            foreach (Cart::content() as $item)
            {
                $totalQty += $item->qty;

            }

            if($shippingInfo !=null)
            {
                $shippingCharge = $totalQty*$shippingInfo->amount;
                $grandTotal = ($subTotal-$discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount' => $discount,
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2)
                ]);

            }
            else
            {
                $shippingInfo = shipping::where('country_id','rest_of_world')->first();

                if($shippingInfo !=null)
            {
                $shippingCharge = $totalQty*$shippingInfo->amount;
                $grandTotal = ($subTotal-$discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount' => $discount,
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2)
                ]);

            }}


        }

        else

        {
            return response()->json([
                'status' => true,
                'grandTotal' => number_format(($subTotal-$discount),2),
                'discount' => $discount,
                'discountString' => $discountString,
                'shippingCharge' => number_format(0,2)
            ]);

        }

    }

    public function applyDiscount(Request $request)
    {
        
        $code = coupon::where('code',$request->code)->first();
        if($code == null)
        {
            return response()->json([
                'status' => false,
                'message' => 'Invalid discount coupon'
            ]);
        }

        $now = Carbon::now();

        if($code->start_at != "")
        {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->start_at);
            if($now->lt($startDate))
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon'
                ]);
            }
        }

        if($code->expires_at != "")
        {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->expires_at);
            if($now->gt($endDate))
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon'
                ]);
            }
        }


        if($code->max_uses >0)
        {
            $couponUsed = order::where('coupon_code_id', $code->id)->count();

            if($couponUsed >= $code->max_uses)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon'
                ]);
    
            }
    
        }
        if($code->max_uses_user >0)
        {
            $couponUsedByUser = order::where(['coupon_code_id' => $code->id, 'user_id' => Auth::user()->id])->count();

            if($couponUsedByUser >= $code->max_uses_user)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'You already used this coupon code'
                ]);

            }
        }

        $subTotal = Cart::subtotal(2,'.','');

        if($code->min_amount >0)
        {
            if($subTotal < $code->min_amount)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'You min amount must be '.$code->min_amount.'dong'
                ]);
            }
        }

        session()->put('code',$code);

        return $this->getOrderSummary($request);
    }


    public function removeCoupon(Request $request)
    {
        session()->forget('code');
        return $this->getOrderSummary($request);
    }
}
