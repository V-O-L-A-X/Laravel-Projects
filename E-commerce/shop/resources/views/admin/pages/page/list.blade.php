@extends('admin.layouts.master')
@section('content')
<div class="row">

<div class="col-lg-12">
          <div class="card"> 
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:30px;">Pages</span>
              
              </h5>
              @include('admin.message')
              
			  <div >
                <div class="row">
                <div class="col-md-4">
              <a class="btn btn-light btn-round mb-2" href="{{route('page.create')}}">Add page</a>
              </div>
              
             <div class="col-md-8">
                <form action="" method="GET">
                    <input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-light btn-round m-2">Search</button><a href="{{route('page.index')}}" class="btn btn-light btn-round m-2">Reset</a>

                </form>
             </div>

            </div>
              <table class="table table-bordered" >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($pages->isNotEmpty())
                    @foreach ($pages as $page)
                  <tr>
                    <th scope="row">{{$page->id}}</th>
                    <td>{{$page->name}}</td>
                    <td>{{$page->slug}}</td>
                    
                  
                   

                    <td>
                    <a href="{{route('page.edit', $page->id)}}"><i class="fa-regular fa-pen-to-square" style="color: #4dff00;"></i></a>
                    
                    <a  onClick="deletePage({{$page->id}})" href="javascript:void(0)"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a>
                    
                    
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
            {{$pages->links()}}
</p>
            </div>
          </div>
          
        </div>
        
      
    </div>

@endsection


@section('customJs') 
<script>
  function deletePage(id){
    var url='{{route("page.destroy","ID")}}';
    var newUrl= url.replace("ID",id);  
    
if(confirm("Are you sure want to delete this page"))
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
                window.location.href="{{route('page.index')}} ";
            }
            
          }
        });
      }
  }
</script>
@endsection