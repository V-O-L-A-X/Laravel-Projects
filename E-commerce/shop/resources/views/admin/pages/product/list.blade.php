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
                    <button type="submit" class="btn btn-light btn-round m-2">Search</button><a href="{{route('product.index')}}" class="btn btn-light btn-round m-2">Reset</a>

                </form>
             </div>

            </div>
              <table class="table table-bordered table-responsive" >
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Action</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>

                    <th scope="col">Price</th>
                    <th scope="col">Compare Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub Caqtegory</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Featured?</th>
                    <th scope="col">Sku</th>
                    <th scope="col">Barcode</th>

                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @if($product->isNotEmpty())
                    @foreach ($product as $pr)
                  <tr>
                    <th scope="row">{{$pr->id}}</th>
                    <td>
                    <a href="{{route('product.edit', $pr->id)}}"><i class="fa-regular fa-pen-to-square" style="color: #4dff00;"></i></a>
                    
                    <a  onClick="deleteProduct({{$pr->id}})" href="javascript:void(0)"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a>
                    
                    
                </td>
                    <td>{{$pr->title}}</td>
                    <td>{{$pr->slug}}</td>

                    <td>{{$pr->price}}</td>
                    <td>{{$pr->compare_price}}</td>
                    <td>{{$pr->category->name}}</td>
                    <td>{{$pr->subcat->name}}</td>
                    <td>{{$pr->brand->name}}</td>
                    <td>{{$pr->is_featured}}</td>
                    <td>{{$pr->sku}}</td>
                    <td>{{$pr->barcode}}</td>
                    <td>{{$pr->qty}} left</td>
                    <td>
                        @if($pr->status == 1)
                    <i class="fa-regular fa-circle-check" style="color: #73ff00;"></i>
                    @else
                    <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
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
            {{$product->links()}}
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
</script>
@endsection