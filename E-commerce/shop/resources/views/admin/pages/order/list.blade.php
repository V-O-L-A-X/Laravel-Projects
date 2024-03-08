@extends('admin.layouts.master')
@section('content')
<div class="row">

<div class="col-lg-12">
          <div class="card"> 
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:30px;">Orders</span>
              
              </h5>
              @include('admin.message')
              
			  <div >
                <div class="row">
                <div class="col-md-4">
              </div>
              
             <div class="col-md-8">
                <form action="" method="GET">
                    <input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-light btn-round m-2">Search</button><a href="{{route('order.index')}}" class="btn btn-light btn-round m-2">Reset</a>

                </form>
             </div>

            </div>
              <table class="table table-bordered" >
                <thead>
                  <tr>
                    <th scope="col">Order#</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date puchased</th>
                  </tr>
                </thead>
                <tbody>
                    @if($orders->isNotEmpty())
                    @foreach ($orders as $order)
                  <tr>
                    <th scope="row"><a href="{{route('order.detail',[$order->id])}}">{{$order->id}}</a></th>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->mobile}}</td>
                    <td>
                    @if($order->status == 'pending')
                    <span class="badge bg-danger">Pending</span>
                    @elseif($order->status == 'shipped')
                    <span class="badge bg-info">Shipped</span>
                    @elseif($order->status == 'delivered')
                    <span class="badge bg-success">Delivered</span>
                    @else
                    <span class="badge bg-warning">Cancelled</span>
                    @endif

                
                    </td>
                    <td>{{number_format($order->grand_total,0,",",".")}} đ</td>
                    <td>
                        {{\Carbon\Carbon::parse($order->created_at)->format('d M, Y')}}
                    </td>


                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>Data not Found</td>
                  </tr>
                  @endif
                </tbody>
              </table>
             
            </div>
            <p>
            {{$orders->links()}}
</p>
            </div>
          </div>
          
        </div>
        

    </div>

@endsection


@section('customJs') 

@endsection