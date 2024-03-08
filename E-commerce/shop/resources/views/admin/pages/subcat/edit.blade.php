@extends('admin.layouts.master')
@section('content')

         <div class="card">
           <div class="card-body">
           <div class="card-title">Edit sub category
           <a class="btn btn-light btn-round" href="{{route('subcat.index')}}">Back</a>
           </div>
           <hr>
            <form class="row" action="" method="POST" name="subcategoryF" id="subcategoryF">
            @csrf 
            <div class="form-group col-md-6">
            <label for="category">Categories</label>
            <select name="category" id="category" class="form-control">
                <option value="">Select a Category</option>
                @if($cat->isNotEmpty())
                @foreach ($cat as $sub)
                <option {{($subcat->category_id == $sub->id) ? 'selected' : ''}} value="{{$sub->id}}">{{$sub->name}}</option>
                
                @endforeach
             
                @endif

            </select>
            <p></p>
            
           </div>
           <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category's Name" value="{{$subcat->name}}">
            <p></p>
           </div>
           <div class="form-group col-md-6">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{$subcat->slug}}">
            <p></p>
           </div>
           
           <div class="form-group col-md-6">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option {{ $subcat->status == 1 ? 'selected': ''}} value="1">Active</option>
                <option {{ $subcat->status == 0 ? 'selected': ''}} value="0">Block</option>
            </select>
           </div>

           <div class="form-group col-md-4">
            <label for="showHome">Show on home</label>
            <select class="form-control" name="showHome" id="showHome">
                <option {{ $subcat->showHome == 'Yes' ? 'selected': ''}} value="Yes">Yes</option>
                <option {{ $subcat->showHome == 'No' ? 'selected': ''}} value="No">No</option>
            </select>
           </div>
          
 

           <div class="form-group col-md-12">
            <button type="submit" class="btn px-5 btn-success"><i class="fa-solid fa-square-plus"></i>Update</button>
            <button type="reset" class="btn px-5 btn-light">Reset</button>
          </div>


          </form>
         </div>
         </div>

@endsection


@section('customJs')
<script>
$("#subcategoryF").submit(function (event) 
{
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("subcat.update", $subcat->id)}}',
        type:'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                window.location.href="{{route('subcat.index')}} ";
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                $("#category").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            else
            {
                if(response['notFound']== true)
                {
                    window.location.href="{{route('subcat.index')}} ";
                    return false;
                }
                var errors = response['errors'];


            if(errors['name'])
            {
                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            }
            else
            {
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }


            if(errors['slug'])
            {
                $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
            }
            else
            {
                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            } 

            if(errors['slug'])
            {
                $("#category").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['category']);
            }
            else
            {
                $("#category").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            } 
            }
            
            

        },error:function(jqXHR, exception){
            console.log("Something went wrong");
        }
    })
});

$("#name").change(function(){
    element = $(this);
    $("button[type=submit]").prop('disabled',true);

    $.ajax({
        url:'{{route("getSlug")}}',
        type:'get',
        data: {title: element.val()},
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                $("#slug").val(response["slug"]);
            }
        }});

});



</script>
@endsection