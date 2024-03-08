@extends('admin.layouts.master')
@section('content')
<div class="row">
<div class="col-lg-2"></div>
<div class="col-lg-8">
          <div class="card"> 
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:30px;">Brand</span>
              
              </h5>
              @include('admin.message')
              
			  <div >
                <div class="row">
                <div class="col-md-4">
              <a class="btn btn-light btn-round mb-2" href="{{route('brand.create')}}">Add brand</a>
              </div>
              
             <div class="col-md-8">
                <form action="" method="GET">
                    <input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-light btn-round m-2">Search</button><a href="{{route('brand.index')}}" class="btn btn-light btn-round m-2">Reset</a>

                </form>
             </div>

            </div>
              <table class="table table-bordered" >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($brand->isNotEmpty())
                    @foreach ($brand as $b)
                  <tr>
                    <th scope="row">{{$b->id}}</th>
                    <td>{{$b->name}}</td>
                    <td>{{$b->slug}}</td>
                    <td>
                        @if($b->status == 1)
                    <i class="fa-regular fa-circle-check" style="color: #73ff00;"></i>
                    @else
                    <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                    @endif

                
                </td>

                    <td>
                    <a href="{{route('brand.edit', $b->id)}}"><i class="fa-regular fa-pen-to-square" style="color: #4dff00;"></i></a>
                    
                    <a  onClick="deleteBrand({{$b->id}})" href="javascript:void(0)"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a>
                    
                    
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
            {{$brand->links()}}
</p>
            </div>
          </div>
          
        </div>
        
        <div class="col-lg-2"></div>
    </div>

@endsection


@section('customJs') 
<script>
  function deleteBrand(id){
    var url='{{route("brand.destroy","ID")}}';
    var newUrl= url.replace("ID",id);  
    
if(confirm("Are you sure want to delete this brand"))
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
                window.location.href="{{route('brand.index')}} ";
            }
            
          }
        });
      }
  }
</script>
@endsection