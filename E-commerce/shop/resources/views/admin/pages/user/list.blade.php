@extends('admin.layouts.master')
@section('content')
<div class="row">

<div class="col-lg-12">
          <div class="card"> 
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:30px;">Users</span>
              
              </h5>
              @include('admin.message')
              
			  <div >
                <div class="row">
                <div class="col-md-4">
              <a class="btn btn-light btn-round mb-2" href="{{route('user.create')}}">Add user</a>
              </div>
              
             <div class="col-md-8">
                <form action="" method="GET">
                    <input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control" placeholder="Search">
                    <button type="submit" class="btn btn-light btn-round m-2">Search</button><a href="{{route('user.index')}}" class="btn btn-light btn-round m-2">Reset</a>

                </form>
             </div>

            </div>
              <table class="table table-bordered" >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                  
                    <th scope="col">Status</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($users->isNotEmpty())
                    @foreach ($users as $user)
                  <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                   
                    <td>
                        @if($user->status == 1)
                    <i class="fa-regular fa-circle-check" style="color: #73ff00;"></i>
                    @else
                    <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                    @endif

                
                    </td>
                    <td>
                        @if($user->role == 2)
                    <i class="fa-solid fa-star" style="color: yellow;"></i>
                    @else
                    <i class="fa-solid fa-star-half-stroke" style="color: #ffffff;"></i>
                    @endif

                
                    </td>

                    <td>
                    <a href="{{route('user.edit', $user->id)}}"><i class="fa-regular fa-pen-to-square" style="color: #4dff00;"></i></a>
                    
                    <a  onClick="deleteUser({{$user->id}})" href="javascript:void(0)"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a>
                    
                    
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
            {{$users->links()}}
</p>
            </div>
          </div>
          
        </div>
        
      
    </div>

@endsection


@section('customJs') 
<script>
  function deleteUser(id){
    var url='{{route("user.destroy","ID")}}';
    var newUrl= url.replace("ID",id);  
    
if(confirm("Are you sure want to delete this user"))
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
                window.location.href="{{route('user.index')}} ";
            }
            
          }
        });
      }
  }
</script>
@endsection