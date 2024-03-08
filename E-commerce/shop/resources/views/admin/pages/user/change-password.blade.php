@extends('admin.layouts.master')
@section('content')

         <div class="card">
         

           <div class="card-body">
           <div class="card-title">Setting
            
           <a class="btn btn-light btn-round" href="{{route('admin.dashboard')}}">Back</a>
           
           </div>
           <hr>
            <form class="row" action="" method="POST" name="changePasswordF" id="changePasswordF">
            @include('admin.message')
           <div class="form-group col-md-12">
            <label for="old_password">Old Password</label>
            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Old Password">
            <p></p>
           </div>

           <div class="form-group col-md-12">
            <label for="new_password">New Password</label>
            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password">
            <p></p>
           </div>

           <div class="form-group col-md-12">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
            <p></p>
           </div>
           
        
           
 

           <div class="form-group col-md-12">
            <button type="submit" class="btn px-5 btn-success"><i class="fa-solid fa-square-plus"></i> Update</button>
            <button type="reset" class="btn px-5 btn-light">Reset</button>
          </div>


          </form>
         </div>
         </div>

@endsection


@section('customJs')
<script>
$("#changePasswordF").submit(function (event) 
{
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("admin.changePassword")}}',
        type:'post',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                window.location.href="{{route('admin.changePasswordForm')}} ";
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            else
            {
                var errors = response['errors'];

            if(errors['old_password'])
            {
                $("#old_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['old_password']);
            }
            else
            {
                $("#old_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['new_password'])
            {
                $("#new_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['new_password']);
            }
            else
            {
                $("#new_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

            if(errors['confirm_password'])
            {
                $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['confirm_password']);
            }
            else
            {
                $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }


            
            }
            

        },error:function(jqXHR, exception){
            console.log("Something went wrong");
        }
    })
});


</script>
@endsection