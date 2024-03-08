@extends('frontend.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-12">
                @include('frontend.account.common.message')
                </div>
                <div class="col-md-3">
                    @include('frontend.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <form action="" method="POST" name="profileF" id="profileF">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">               
                                    <label for="name">Name</label>
                                    <input value="{{$user->name}}" type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3">            
                                    <label for="email">Email</label>
                                    <input value="{{$user->email}}" type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3">                                    
                                    <label for="phone">Phone</label>
                                    <input value="{{$user->phone}}" type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control">
                                    <p></p>
                                </div>


                                <div class="d-flex">
                                    <button class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </div>
                        </form>


                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2 mt-4">Address</h2>
                        </div>
                        <form action="" method="POST" name="addressF" id="addressF">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3 col-md-6">               
                                    <label for="first_name">First Name</label>
                                    <input value="{{(!empty($address)) ? $address->first_name : ''}}" type="text" name="first_name" id="first_name" placeholder="Enter Your First Name" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3 col-md-6">               
                                    <label for="last_name">Last Name</label>
                                    <input value="{{(!empty($address)) ? $address->last_name : ''}}" type="text" name="last_name" id="last_name" placeholder="Enter Your Last Name" class="form-control">
                                     
                                </div>
                                <div class="mb-3 col-md-6">            
                                    <label for="email">Email</label>
                                    <input value="{{(!empty($address)) ? $address->email : ''}}" type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3 col-md-6">                                    
                                    <label for="mobile">Mobile</label>
                                    <input value="{{(!empty($address)) ? $address->mobile : ''}}" type="text" name="mobile" id="mobile" placeholder="Enter Your Phone" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3">                                    
                                    <label for="country">Country</label>
                                    <select name="country_id" id="country_id" class="form-control">
                                        <option value="">Select a country </option>
                                        @if($countries->isNotEmpty())
                                        @foreach($countries as $country)
                                        <option {{(!empty($address) && $address->country_id == $country->id) ? 'selected' : ''}} value="{{$country->id}}">{{$country->name}} </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-3">                                    
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{(!empty($address)) ? $address->address : ''}}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-3 col-md-6">                                    
                                    <label for="apartment">Apartment</label>
                                    <input value="{{(!empty($address)) ? $address->apartment : ''}}" type="text" name="apartment" id="apartment" placeholder="Enter Your Apartment" class="form-control">
                                    
                                </div>
                                <div class="mb-3 col-md-6">                                    
                                    <label for="city">City</label>
                                    <input value="{{(!empty($address)) ? $address->city : ''}}" type="text" name="city" id="city" placeholder="Enter Your City" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3 col-md-6">                                    
                                    <label for="state">State</label>
                                    <input value="{{(!empty($address)) ? $address->state : ''}}" type="text" name="state" id="state" placeholder="Enter Your State" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3 col-md-6">                                    
                                    <label for="zip">Zip</label>
                                    <input value="{{(!empty($address)) ? $address->zip : ''}}" type="text" name="zip" id="zip" placeholder="Enter Your Zip" class="form-control">
                                    <p></p>
                                </div>


                                <div class="d-flex">
                                    <button class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </div>
                        </form>




                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script>
    $("#profileF").submit(function(event){
        event.preventDefault();

        $.ajax({
            url:'{{route("account.updateProfile")}}',
            type: 'post',
            data:$(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                if(response.status == true)
                {



                    $("#profileF #name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#profileF #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#profileF #phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    window.location.href = '{{route("account.profile")}}'


                }
                else
                {
                    var errors = response.errors;
                    if(errors.name)
                    {
                        $("#profileF #name").addClass('is-invalid').siblings('p').html(errors.name).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#profileF #name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }

                    if(errors.email)
                    {
                        $("#profileF #email").addClass('is-invalid').siblings('p').html(errors.email).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#profileF #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }

                    if(errors.phone)
                    {
                        $("#profileF #phone").addClass('is-invalid').siblings('p').html(errors.phone).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#profileF #phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                }
            }
        });
    });



    $("#addressF").submit(function(event){
        event.preventDefault();

        $.ajax({
            url:'{{route("account.updateAddress")}}',
            type: 'post',
            data:$(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                if(response.status == true)
                {



                    $("#name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    window.location.href = '{{route("account.profile")}}'


                }
                else
                {
                    var errors = response.errors;
                    if(errors.first_name)
                    {
                        $("#addressF #first_name").addClass('is-invalid').siblings('p').html(errors.first_name).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #first_name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }



                    if(errors.email)
                    {
                        $("#addressF #email").addClass('is-invalid').siblings('p').html(errors.email).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                    if(errors.mobile)
                    {
                        $("#addressF #mobile").addClass('is-invalid').siblings('p').html(errors.mobile).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #mobile").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                    if(errors.country_id)
                    {
                        $("#addressF #country_id").addClass('is-invalid').siblings('p').html(errors.country_id).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #country_id").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                    if(errors.address)
                    {
                        $("#addressF #address").addClass('is-invalid').siblings('p').html(errors.address).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #address").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                    if(errors.city)
                    {
                        $("#addressF #city").addClass('is-invalid').siblings('p').html(errors.city).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #city").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                    if(errors.state)
                    {
                        $("#addressF #state").addClass('is-invalid').siblings('p').html(errors.state).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #state").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                    if(errors.zip)
                    {
                        $("#addressF #zip").addClass('is-invalid').siblings('p').html(errors.zip).addClass('invalid-feedback');
                    }
                    else
                    {
                        $("#addressF #zip").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                    }
                }
            }
        });
    });

</script>
@endsection