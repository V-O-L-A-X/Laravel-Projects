@extends('admin.layouts.master')
@section('content')

         <div class="card">
           <div class="card-body">
           <div class="card-title">Edit category
           <a class="btn btn-light btn-round" href="{{route('category.index')}}">Back</a>
           </div>
           <hr>
            <form class="row" action="" method="POST" name="categoryF" id="categoryF">
           <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category's Name" value="{{$category->name}}">
            <p></p>
           </div>
           <div class="form-group col-md-4">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{$category->slug}}" readonly>
            <p></p>
           </div>
           
           <div class="form-group col-md-4">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option {{ $category->status == 1 ? 'selected': ''}} value="1">Active</option>
                <option {{ $category->status == 0 ? 'selected': ''}} value="0">Block</option>
            </select>
           </div>

           <div class="form-group col-md-4">
            <label for="showHome">Show on home</label>
            <select class="form-control" name="showHome" id="showHome">
                <option {{ $category->showHome == 'Yes' ? 'selected': ''}} value="Yes">Yes</option>
                <option {{ $category->showHome == 'No' ? 'selected': ''}} value="No">No</option>
            </select>
           </div>

           <div class="form-group col-md-6">
            <input type="hidden" id="image_id" name="image_id" value="">
           <label for="image">Image</label>
           <div id="image" class="dropzone dz-clickable">
                <div class="dz-message needsclick" style="color:black;">    
                    <br>Drop files here or click to upload.<br><br>                                            
                </div>
            </div>
            
           </div>
           
           @if(!empty($category->image))
            <div class="col-md-6">
                <img width="250" src="uploads/category/thumb/{{$category->image}}" alt="">
            </div>
            @endif
 

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
$("#categoryF").submit(function (event) 
{
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("category.update", $category->id)}}',
        type:'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                window.location.href="{{route('category.index')}} ";
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            else
            {
                if(response['notFound']== true)
                {
                    window.location.href="{{route('category.index')}} ";
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

Dropzone.autoDiscover = false;    
const dropzone = $("#image").dropzone({ 
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url:  "{{ route('temp-images.create') }}",
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        $("#image_id").val(response.image_id);
        //console.log(response)
    }
});

</script>
@endsection