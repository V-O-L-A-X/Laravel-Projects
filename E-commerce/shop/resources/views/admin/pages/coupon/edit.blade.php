@extends('admin.layouts.master')
@section('content')

         <div class="card">
           <div class="card-body">
           <div class="card-title">Edit Coupon Code
           <a class="btn btn-light btn-round" href="{{route('coupons.index')}}">Back</a>
           </div>
           <hr>
            <form class="row" action="" method="POST" name="discountF" id="discountF">
           <div class="form-group col-md-6">
            <label for="code">Code</label>
            <input value="{{$coupons->code}}" type="text" class="form-control" name="code" id="code" placeholder="Enter Coupon's Code">
            <p></p>
           </div>

           <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input value="{{$coupons->name}}" type="text" class="form-control" name="name" id="name" placeholder="Enter Coupon's Name">
            <p></p>
           </div>

           

           <div class="form-group col-md-3">
            <label for="max_uses">Max uses</label>
            <input value="{{$coupons->max_uses}}" type="number" class="form-control" name="max_uses" id="max_uses" placeholder="Enter Coupon's Max Uses">
            <p></p>
           </div>

           <div class="form-group col-md-3">
            <label for="max_uses_user">Max uses user</label>
            <input value="{{$coupons->max_uses_user}}" type="text" class="form-control" name="max_uses_user" id="max_uses_user" placeholder="Enter Coupon's Max Uses User">
            <p></p>
           </div>

           
           <div class="form-group col-md-3">
            <label for="type">Type</label>
            <select class="form-control" name="type" id="type">
                <option {{($coupons->type == 'percent') ? 'selected' : ''}} value="percent">Percent</option>
                <option {{($coupons->type == 'fixed') ? 'selected' : ''}} value="fixed">Fixed</option>
            </select>
           </div>

           <div class="form-group col-md-3">
            <label for="discount_amount">Discount Amount</label>
            <input value="{{$coupons->discount_amount}}" type="text" class="form-control" name="discount_amount" id="discount_amount" placeholder="Enter Coupon's Discount Amount">
            <p></p>
           </div>

           <div class="form-group col-md-3">
            <label for="min_amount">Min Amount</label>
            <input value="{{$coupons->min_amount}}" type="text" class="form-control" name="min_amount" id="min_amount" placeholder="Enter Coupon's Min Amount">
            <p></p>
           </div>

           <div class="form-group col-md-3">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option {{($coupons->status == 1) ? 'selected' : ''}} value="1">Active</option>
                <option {{($coupons->status == 0) ? 'selected' : ''}} value="0">Block</option>
            </select>
           </div>

           <div class="form-group col-md-3">
            <label for="start_at">Start at</label>
            <input value="{{$coupons->start_at}}" autocomplete="off" type="text" class="form-control" name="start_at" id="start_at" placeholder="Enter Coupon's Start At">
            <p></p>
           </div>

           <div class="form-group col-md-3">
            <label for="expires_at">Expires at</label>
            <input value="{{$coupons->expires_at}}" autocomplete="off" type="text" class="form-control" name="expires_at" id="expires_at" placeholder="Enter Coupon's Expires At">
            <p></p>
           </div>

           <div class="form-group col-md-12">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="summernote" placeholder="Description"  cols="30" rows="10" style="color:white;">{{$coupons->description}}</textarea>
            <p></p>
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

$(document).ready(function(){
    $('#start_at').datetimepicker({
        // options here
        format:'Y-m-d H:i:s',
    });
});

$(document).ready(function(){
    $('#expires_at').datetimepicker({
        // options here
        format:'Y-m-d H:i:s',
    });
});
        
        


$("#discountF").submit(function (event) 
{
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("coupons.update",$coupons->id)}}',
        type:'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){

            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                window.location.href="{{route('coupons.index')}} ";

                $("#code").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback').html("");

                $("#discount_amount").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback').html("");

                $("#start_at").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback').html("");

                $("#expires_at").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback').html("");

                
            }
            else
            {
                var errors = response['errors'];

            if(errors['code'])
            {
                $("#code").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['code']);
            }
            else
            {
                $("#code").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }


            if(errors['discount_amount'])
            {
                $("#discount_amount").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['discount_amount']);
            }
            else
            {
                $("#discount_amount").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            } 

            if(errors['start_at'])
            {
                $("#start_at").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['start_at']);
            }
            else
            {
                $("#start_at").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            } 

            if(errors['expires_at'])
            {
                $("#expires_at").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['expires_at']);
            }
            else
            {
                $("#expires_at").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            } 

            
            }
            

        },error:function(jqXHR, exception){
            console.log("Something went wrong");
        }
    })
});







</script>
@endsection