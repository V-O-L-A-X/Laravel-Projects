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
                <option value="{{$country->id}}">{{$country->name}}</option> 
                @endforeach
                <option value="rest_of_world">Rest of the world</option>
                @endif

            </select>
            <p></p>
           </div>
            <div class="col-md-4">

                <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter the amount">
                <p></p>

            </div>
           <div class="col-md-4">

            <button id="nut" type="submit" class="btn px-5 btn-success"><i class="fa-solid fa-square-plus"></i> Add</button>
            <button type="reset" class="btn px-5 btn-light">Reset</button>
          </div>


          </form>

          <div class="card">
          <div class="card-body">
          <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Country</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                    
                </tr>
                </thead>
                <tbody>
                @if($shippingCharges->isNotEmpty())
                @foreach ($shippingCharges  as $shippingCharge)
                <tr>
                    <th scope="row">{{$shippingCharge->id}}</td>
                    <td>{{($shippingCharge->country_id == 'rest_of_world') ? 'Rest of the world' : $shippingCharge->country->name}}</td>
                    <td>{{$shippingCharge->amount}}</td>
                    <td>

                    <a href="{{route('shipping.edit', $shippingCharge->id)}}"><i class="fa-regular fa-pen-to-square" style="color: #4dff00;"></i></a>
                    
                    <a onClick="deleteShipping({{$shippingCharge->id}})"  href="javascript:void(0)"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a>
                    

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
            
            </div>
            
        </div>
          </div>
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
        url:'{{route("shipping.store")}}',
        type:'post',
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


function deleteShipping(id){
    var url='{{route("shipping.destroy","ID")}}';
    var newUrl= url.replace("ID",id);  
    
if(confirm("Are you sure want to delete this shipping"))
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
                window.location.href="{{route('shipping.create')}} ";
            }
            
          }
        });
      }
  }


</script>
@endsection