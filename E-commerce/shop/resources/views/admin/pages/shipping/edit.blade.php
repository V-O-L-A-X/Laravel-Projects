@extends('admin.layouts.master')
@section('content')

         <div class="card">
           <div class="card-body">
           <div class="card-title">Shipping Management
           <a class="btn btn-light btn-round" href="{{route('category.index')}}">Back</a>
           </div>
           <hr>
           @include('admin.message')
           <form class="row" action="" method="POST" name="shippingF" id="shippingF">
           
           <div class="form-group col-md-4">

            <select name="country" id="country" class="form-control">
                <option value="">Select a Country</option> 
                @if($countries->isNotEmpty())
                @foreach ($countries as $country)
                <option {{($shippingCharges->country_id == $country->id) ? 'selected' : ''}} value="{{$country->id}}">{{$country->name}}</option> 
                @endforeach
                <option {{($shippingCharges->country_id == 'rest_of_world') ? 'selected' : ''}} value="rest_of_world">Rest of the world</option>
                @endif

            </select>
            <p></p>
           </div>
            <div class="col-md-4">

                <input value="{{$shippingCharges->amount}}" type="text" name="amount" id="amount" class="form-control" placeholder="Enter the amount">
                <p></p>

            </div>
           <div class="col-md-4">

            <button id="nut" type="submit" class="btn px-5 btn-success">
                <i class="fa-solid fa-square-plus"></i> Update
            </button>
            <button type="reset" class="btn px-5 btn-light">Reset</button>
          </div>


          </form>

          
         </div>
         </div>

@endsection


@section('customJs')
<script>
$("#shippingF").submit(function (event) 
{
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("shipping.update", $shippingCharges->id)}}',
        type:'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                window.location.href="{{route('shipping.create')}} ";
            }
            else
            {
                var errors = response['errors'];

            if(errors['country'])
            {
                $("#country").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['country']);
            }
            else
            {
                $("#country").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }


            if(errors['amount'])
            {
                $("#amount").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['amount']);
            }
            else
            {
                $("#amount").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            } 
            }
            

        },error:function(jqXHR, exception){
            console.log("Something went wrong");
        }
    })
});





</script>
@endsection