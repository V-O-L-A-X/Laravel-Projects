@extends('admin.layouts.master')
@section('content')

<div class="card mt-3">
  <div class="card-content">
      <div class="row row-group m-0">
     
          <div class="col-12 col-lg-6 col-xl-3 border-light button-slide"><a href="{{route('order.index')}}">
          
              <div class="card-body  ">
                
                <h5 class="text-white mb-0">{{$totalOrders}}<span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                      <div class="progress-bar" style="width:55%"></div>
                  </div>
                <p class="mb-0 text-white small-font">Total Orders <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
              </div></a>
          </div>
          <div class="col-12 col-lg-6 col-xl-3 border-light button-slide"><a href="{{route('product.index')}}">
              <div class="card-body">
                <h5 class="text-white mb-0">{{$totalProducts}} <span class="float-right"><i class="fa-solid fa-boxes-packing"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                      <div class="progress-bar" style="width:55%"></div>
                  </div>
                <p class="mb-0 text-white small-font">Total Products<span class="float-right">+1.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
              </div></a>
          </div>
          <div class="col-12 col-lg-6 col-xl-3 border-light button-slide"><a href="{{route('user.index')}}">
              <div class="card-body">
                <h5 class="text-white mb-0">{{$totalCustomers}} <span class="float-right"><i class="fa-solid fa-people-group"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                      <div class="progress-bar" style="width:55%"></div>
                  </div>
                <p class="mb-0 text-white small-font">Customers <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
              </div></a>
          </div>
          <div class="col-12 col-lg-6 col-xl-3 border-light button-slide">
              <div class="card-body">
                <h5 class="text-white mb-0">{{number_format($totalRevenue, 0, ',', '.')}} đ<span class="float-right"><i class="fa-solid fa-circle-dollar-to-slot"></i></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                      <div class="progress-bar" style="width:55%"></div>
                  </div>
                <p class="mb-0 text-white small-font">Total Revenue <span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
              </div>
          </div>
          <div class="col-12 col-lg-12 col-xl-12 border-light border-top border-right">
            
          </div>


          <div class="col-12 col-lg-6 col-xl-3 border-light border-right button-slide">
              <div class="card-body">
                <h5 class="text-white mb-0">{{number_format($revenueThisMonth, 0, ',', '.')}} đ <span class="float-right"><i class="fa-solid fa-comments-dollar"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                      <div class="progress-bar" style="width:55%"></div>
                  </div>
                <p class="mb-0 text-white small-font">Revenue This Month <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
              </div>
          </div>

          <div class="col-12 col-lg-6 col-xl-3 border-light button-slide border-right">
              <div class="card-body">
                <h5 class="text-white mb-0">{{number_format($revenueLastMonth, 0, ',', '.')}} đ <span class="float-right"><i class="fa-solid fa-sack-dollar"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                      <div class="progress-bar" style="width:55%"></div>
                  </div>
                <p class="mb-0 text-white small-font">Revenue Last Month ({{$lastMonthName}}) <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
              </div>
          </div>

          <div class="col-12 col-lg-6 col-xl-3 border-light button-slide border-right">
              <div class="card-body">
                <h5 class="text-white mb-0">{{number_format($revenueLastThirtyDays, 0, ',', '.')}} đ <span class="float-right"><i class="fa-solid fa-magnifying-glass-dollar"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                      <div class="progress-bar" style="width:55%"></div>
                  </div>
                <p class="mb-0 text-white small-font">Revenue Last 30 Days <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
              </div>
          </div>

      </div>
  </div>
</div> 

@endsection

@section('customJs')
<script>

</script>
@endsection