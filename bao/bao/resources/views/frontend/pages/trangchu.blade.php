@extends("frontend.layouts.master")
@section("content")
<div class="container">

    	<!-- slider -->
    	@include("frontend.layouts.slide")
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
        @include("frontend.layouts.menu")

            <div class="col-md-9">
	            <div class="panel panel-default">
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
						@foreach($theloai as $tl)
						@if(count($tl->loaitin)>0)
					    <div class="row-item row">
		                	<h3>
		                		<a href="#">{{$tl->Ten}}</a> |
								@foreach($tl->loaitin as $lt)
		                		<small><a href="{{route('loaitin',[$lt->id, $lt->TenKhongDau])}}"><i>{{$lt->Ten}}</i></a>/</small>
								@endforeach		                		
		                	</h3>

							@php ($data = $tl->tintuc->where("NoiBat","=",1)->sortByDesc('id')->take(5))
							@php ($tin1 = $data->shift())
							

		                	<div class="col-md-8 border-right">
							
		                		<div class="col-md-5">

								 
								<a 
								@foreach($data as $tc)
								href="{{route('tintuc',[$tc->id, $tin1->TieuDeKhongDau])}}"
								@endforeach
								> 
								

										
										@if(isset($tin1["Hinh"]))

			                            <img class="img-responsive" src="images/{{$tin1['Hinh']}}" alt="{{$tin1['Hinh']}}">
										@else
										<img class="img-responsive" src="images/320x150.png" alt="320x150">
										@endif
			                        </a>
									
			                    </div>

			                    <div class="col-md-7">
			                        <h3>{{isset($tin1['TieuDe'])? $tin1['TieuDe']:"aaaa"}}</h3>
			                        <p>{{isset($tin1['TomTat'])? $tin1['TomTat']:"bbbb"}}</p>
									
			                        <a class="btn btn-primary" 
									@foreach($data as $tc)
									href="{{route('tintuc',[$tc->id, $tin1->TieuDeKhongDau])}}"
									@endforeach
									
									> 
									
										Xem Thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
									
								</div>
							

		                	</div>


							<div class="col-md-4">

								@foreach($data as $tt)
								<a href="{{route('tintuc',[$tt->id, $tt->TieuDeKhongDau])}}">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{isset($tt['TieuDe'])? $tt['TieuDe']:""}}
									</h4>
								</a>
								@endforeach


							</div>

							<div class="break"></div>
		                </div>
						@endif
						@endforeach
						
		                <!-- end item -->
		                

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
@endsection