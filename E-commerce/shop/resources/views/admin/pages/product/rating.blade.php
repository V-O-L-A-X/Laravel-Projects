@extends('admin.layouts.master')
@section('content')
<div class="row">

<div class="col-lg-12">
          <div class="card"> 
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:30px;">Product</span>
              
              </h5>
              @include('admin.message')
              
			  <div >
                <div class="row">
                <div class="col-md-4">
              <a class="btn btn-light btn-round mb-2" href="{{route('product.create')}}">Add Product</a>
              </div>
              
             <div class="col-md-8 ">
                <form action="" method="GET">
                    <input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-light btn-round m-2">Search</button><a href="{{route('product.productRating')}}" class="btn btn-light btn-round m-2">Reset</a>

                </form>
             </div>

            </div>
              <table class="table table-bordered " >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Rated By</th>                  
                    
                    <th scope="col">Status</th>
                    
                  </tr>
                </thead>
                <tbody>
                     @if($ratings->isNotEmpty())
                    @foreach ($ratings as $rating)
                  <tr>
                    <th scope="row">{{$rating->id}}</th>
                   
                    <td>{{$rating->product->title}}</td>
                    <td>{{$rating->rating}}</td>
                    <td>{{$rating->comment}}</td>
                    <td>{{$rating->username}}</td>

                    <td>
                    @if($rating->status == 1)
                    <a href="javascript:void(0);" onClick="changeStatus(0,'{{$rating->id}}');">
                    <i class="fa-regular fa-circle-check" style="color: #73ff00;"></i>
                    </a>
                    @else
                    <a href="javascript:void(0);" onClick="changeStatus(1,'{{$rating->id}}');">
                    <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                    </a>
                    @endif
             
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
            {{$ratings->links()}} 
</p>
            </div>
          </div>
          
        </div>
        
        
    </div>

@endsection


@section('customJs') 
<script>
  function deleteProduct(id){
    var url='{{route("product.destroy","ID")}}';
    var newUrl= url.replace("ID",id);  
    
if(confirm("Are you sure want to delete this product"))
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
                window.location.href="{{route('product.index')}} ";
            }
            
          }
        });
      }
  }

function changeStatus(status,id){
    if(confirm("Are you sure want to change status?"))
    {
        $.ajax({
            url:'{{route("product.changeRatingStatus")}}',
            type:'get',
            data: {status:status, id:id},
            dataType: 'json',
            success: function(response){
                if(response["status"])
                {
                  window.location.href="{{route('product.productRating')}} ";
                }
                
            }
            });
    }
}
</script>
@endsection