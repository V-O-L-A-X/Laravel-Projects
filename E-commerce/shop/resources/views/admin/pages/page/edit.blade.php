@extends('admin.layouts.master')
@section('content')

         <div class="card">
           <div class="card-body">
           <div class="card-title">Edit Static Page
           <a class="btn btn-light btn-round" href="{{route('page.index')}}">Back</a>
           </div>
           <hr>
            <form class="row" action="" method="POST" name="pageF" id="pageF">
            @csrf 
            
           <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input value="{{$page->name}}" type="text" class="form-control" name="name" id="name" placeholder="Enter User's Name">
            <p></p>
           </div>

           <div class="form-group col-md-6">
            <label for="slug">Slug</label>
            <input value="{{$page->slug}}" type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
        
           </div>         

           
           
           
           <div class="col-md-12">
                <div class="mb-3">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="summernote" placeholder="Content"  cols="30" rows="10" style="color:white;">{!! $page->content !!}</textarea>
                </div>
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
$("#pageF").submit(function (event) 
{
    event.preventDefault();
    var element = $(this);

    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("page.update",$page->id)}}',
        type:'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                
                window.location.href="{{route('page.index')}} ";
                

               
            }
            else
            {
                var errors = response['errors'];

            if(errors['name'])
            {
                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            }
            else
            {
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
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