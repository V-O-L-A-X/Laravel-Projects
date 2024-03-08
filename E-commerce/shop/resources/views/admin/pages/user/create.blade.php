@extends('admin.layouts.master')
@section('content')

         <div class="card">
           <div class="card-body">
           <div class="card-title">Add User
           <a class="btn btn-light btn-round" href="{{route('user.index')}}">Back</a>
           </div>
           <hr>
            <form class="row" action="" method="POST" name="userF" id="userF">
            @csrf 
            
           <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter User's Name">
            <p></p>
           </div>


           <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter User's Email">
            <p></p>
           </div>
           <div class="form-group col-md-6">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter User's Phone">
            <p></p>
           </div>


           <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter User's Password">
            <p></p>
           </div>

           <!-- <div class="form-group col-md-4">
            <label for="role">Role</label>
            <select class="form-control" name="role" id="role">
                <option value="1">Active</option>
                <option value="0">Block</option>
            </select>
           </div> -->

           
           
           <div class="form-group col-md-6">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="1">Active</option>
                <option value="0">Block</option>
            </select>
           </div>
           
           
 

           <div class="form-group col-md-12">
            <button type="submit" class="btn px-5 btn-success"><i class="fa-solid fa-square-plus"></i> Add</button>
            <button type="reset" class="btn px-5 btn-light">Reset</button>
          </div>


          </form>
         </div>
         </div>

@endsection


@section('customJs')
<script>
$("#userF").submit(function (event) 
{
    event.preventDefault();
    var element = $(this);

    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("user.store")}}',
        type:'post',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                window.location.href="{{route('user.index')}} ";
                

               
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

            if(errors['email'])
            {
                $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
            }
            else
            {
                $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

            if(errors['phone'])
            {
                $("#phone").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
            }
            else
            {
                $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['password'])
            {
                $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
            }
            else
            {
                $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }



            
            }
            

        },error:function(jqXHR, exception){
            console.log("Something went wrong");
        }
    })
});





</script>
@endsection