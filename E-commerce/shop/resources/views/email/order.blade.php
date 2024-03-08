<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Email</title>
  </head>
  <body style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">
    @if($mailData['userType'] == 'customer')
    <h1>Thanks for your order!</h1>
    <h2>Your Order Id Is: #{{$mailData['order']->id}}</h2>
    @else
    <h1>You have received an order</h1>
    <h2>Order Id: #{{$mailData['order']->id}}</h2>
    @endif
  

    <h1>Shipping Address</h1>
    <address>
        <strong>{{$mailData['order']->first_name.' '.$mailData['order']->last_name}}</strong><br>
        - Đ/C: {{$mailData['order']->address}}<br>
        {{$mailData['order']->city}}, {{getCountryInfo($mailData['order']->country_id)->name}}, {{$mailData['order']->zip}}<br>
        - Phone: {{$mailData['order']->mobile}}<br>
        - Email: {{$mailData['order']->email}}
    </address>
    <table cellpadding="3" cellspacing="3" border="0" width="700">
                            <thead>
                                <tr style="background: #CCC;">
                                    <th>Product</th>
                                    <th >Price</th>
                                    <th >Qty</th>                                        
                                    <th >Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mailData['order']->items as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{number_format($item->price,0,",",".")}} đ</td>                                        
                                    <td>{{$item->qty}}</td>
                                    <td>{{number_format($item->total,0,",",".")}} đ</td>
                                </tr>
                                @endforeach
                                
                                <tr>
                                    <th colspan="3" align="right">Subtotal:</th>
                                    <td>{{number_format($mailData['order']->subtotal,0,",",".")}} đ</td>
                                </tr>
                                <tr>
                                    <th colspan="3" align="right">Discount: {{(!empty($mailData['order']->coupon_code)) ? '('. $mailData['order']->coupon_code .')' : ''}}</th>
                                    <td>{{number_format($mailData['order']->discount,0,",",".")}} đ</td>
                                </tr>
                                
                                <tr>
                                    <th colspan="3" align="right">Shipping:</th>
                                    <td>{{number_format($mailData['order']->shipping,0,",",".")}} đ</td>
                                </tr>
                                <tr>
                                    <th colspan="3" align="right">Grand Total:</th>
                                    <td>{{number_format($mailData['order']->grand_total,0,",",".")}} đ</td>
                                </tr>
                            </tbody>
                        </table>	
  </body>
</html>