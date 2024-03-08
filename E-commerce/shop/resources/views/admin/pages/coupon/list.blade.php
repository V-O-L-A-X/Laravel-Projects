@extends('admin.layouts.master')
@section('content')
<div class="row">

<div class="col-lg-12">
          <div class="card"> 
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:30px;">Discount Coupons</span>
              
              </h5>
              @include('admin.message')
              
			  <div >
                <div class="row">
                <div class="col-md-4">
              <a class="btn btn-light btn-round mb-2" href="{{route('coupons.create')}}">Add Discount Coupony</a>
              </div>
              
             <div class="col-md-8">
                <form action="" method="GET">
                    <input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-light btn-round m-2">Search</button><a href="{{route('coupons.index')}}" class="btn btn-light btn-round m-2">Reset</a>

                </form>
             </div>

            </div>
              <table class="table table-bordered" >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Start date</th>
                    <th scope="col">Expires Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($discountCoupons->isNotEmpty())
                    @foreach ($discountCoupons as $coupon)
                  <tr>
                    <th scope="row">{{$coupon->id}}</th>
                    <td>{{$coupon->code}}</td>
                    <td>{{$coupon->name}}</td>
                    <td>
                        @if($coupon->type =='percent')
                        {{$coupon->discount_amount}}%
                        @else
                        {{$coupon->discount_amount}} d
                        @endif
                    </td>

                    <td>
                        {{(!empty($coupon->start_at)) ? \Carbon\Carbon::parse($coupon->start_at)->format('Y/m/d H:i:s') : '' }}
                    </td>
                    <td>
                        {{(!empty($coupon->expires_at)) ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y/m/d H:i:s') : '' }}

                    </td>


                    <td>
                        @if($coupon->status == 1)
                    <i class="fa-regular fa-circle-check" style="color: #73ff00;"></i>
                    @else
                    <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                    @endif

                
                </td>

                    <td>
                    <a href="{{route('coupons.edit', $coupon->id)}}"><i class="fa-regular fa-pen-to-square" style="color: #4dff00;"></i></a>
                    
                    <a  onClick="deleteCoupon({{$coupon->id}})" href="javascript:void(0)"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a>
                    
                    
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
            {{$discountCoupons->links()}}
</p>
            </div>
          </div>
          
        </div>
        
     
    </div>

@endsection


@section('customJs') 
<script>
  function deleteCoupon(id){
    var url='{{route("coupons.destroy","ID")}}';
    var newUrl= url.replace("ID",id);  
    
if(confirm("Are you sure want to delete this Coupon"))
{
    $.ajax({
        url:newUrl,
        type:'delete',
        data: {},
        dataType: 'json',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            if(response["status"])
            {
                window.location.href="{{route('coupons.index')}} ";
            }
            
          }
        });
      }
  }
</script>
@endsection