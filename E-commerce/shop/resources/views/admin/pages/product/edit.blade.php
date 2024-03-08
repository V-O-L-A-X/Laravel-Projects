@extends('admin.layouts.master')
@section('content')

         <div class="card">
           <div class="card-body">
           <div class="card-title">Edit Product
           <a class="btn btn-light btn-round" href="{{route('product.index')}}">Back</a>
           </div>
           <hr>
            <form class="row" action="" method="POST" name="productF" id="productF">

                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{$product->title}}">	
                                                    <p class="error"></p>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Slug</label>
                                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly value="{{$product->slug}}">	
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="short_description">Short Description</label>
                                                    <textarea name="short_description" id="short_description" class="summernote" placeholder="Short Description"  cols="30" rows="10" style="color:white;">{{$product->short_description}}</textarea>
                                                </div>
                                            </div>   
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" class="summernote" placeholder="Description"  cols="30" rows="10" style="color:white;">{{$product->description}}</textarea>
                                                </div>
                                            </div>    
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="shipping_returns">Shipping and Returns</label>
                                                    <textarea name="shipping_returns" id="shipping_returns" class="summernote" placeholder="shipping_returns"  cols="30" rows="10" style="color:white;">{{$product->shipping_returns}}</textarea>
                                                </div>
                                            </div>  

                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Media</h2>								
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick" style="color:black;">    
                                                <br>Drop files here or click to upload.<br><br>                                            
                                            </div>
                                            
                                        </div>
                                        <div class="row" id="product_gallery">
                                        @if($product->productimage->isNotEmpty())
                                        @foreach($product->productimage as $pi)
                                        <div class="col-md-3" id="image-row-{{$pi->id}}"><div class="card">
                                        <input type="hidden" name="image_array[]" value="{{$pi->product->id}}">
                                            <img src="uploads/product/small/{{$pi->image}}" class="card-img-top" alt="">
                                            <div class="card-body">
                                                <a href="javascript:void(0)" onClick="deleteImage({{$pi->id}})" class="btn btn-danger">Delete</a>
                                            </div>
                                            </div></div>
                                        @endforeach
                                        @endif
                                        </div> 
                                    </div>	  
                                                                                                       
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price" value="{{$product->price}}">	
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="compare_price">Compare at Price</label>
                                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price" value="{{$product->compare_price}}">
                                                    <p class="mt-3" style="font-color:white;">
                                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                                    </p>	
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Inventory</h2>								
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="sku" value="{{$product->sku}}">
                                                    <p class="error"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode" value="{{$product->barcode}}">	
                                                </div>
                                            </div> 
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="hidden" name="track_qty" value="No">
                                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes" {{($product->track_qty == 'Yes') ? 'checked' : ''}}>
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty" value="{{$product->qty}}">	
                                                    <p class="error"></p>
                                                </div>
                                            </div> 
                                            <div class="col-12">                                           
                                              
                                                    <h2 class="h4 mb-3">Related products</h2>
                                                    <div class="mb-3">
                                                        <select multiple name="related_products[]" id="related_products" class=" related-product w-100 form-control" >
                                                            @if(!empty($relatedProducts))
                                                            @foreach($relatedProducts as $relpro)
                                                            <option selected value="{{$relpro->id}}">{{$relpro->title}}</option>
                                                            @endforeach
                                                            @endif                                            
                                                        </select>

                                                        <p class="error"></p>
                                                    </div>
                                            </div>
                                                                                          
                                        </div>
                                    </div>	                                                                      
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                            <option {{ $product->status == 1 ? 'selected': ''}} value="1">Active</option>
                                            <option {{ $product->status == 0 ? 'selected': ''}} value="0">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Choose a Category</option>
                                                @if($category->isNotEmpty())
                                                @foreach ($category as $cat)
                                                <option value="{{$cat->id}}"  @if($product->subcat->category->id==$cat->id)
                                        {{"selected"}}
                                        @endif >{{$cat->name}}</option>
                                                @endforeach
                                                @endif
                                           
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category">Sub category</label>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                                <option value="">Choose a Sub Category</option>
                                                @foreach ($subcat as $sub)
                                                <option value="{{ $sub->id }}" class='parent-{{ $sub->category_id }} subcategory' @if($product->subcat->id==$sub->id)
                                        {{"selected"}}
                                        @endif >{{ $sub->name }}</option>
                                            @endforeach
                                               
                                            </select>
                                            
                                            

                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product brand</h2>
                                        <div class="mb-3">
                                            <select name="brand" id="brand" class="form-control">
                                                <option value="">Choose a brand</option>
                                                @if($brand->isNotEmpty())
                                                @foreach ($brand as $br)
                                                <option value="{{$br->id}}" @if($product->brand->id==$br->id)
                                        {{"selected"}}
                                        @endif >{{$br->name}}</option>
                                                @endforeach
                                                @endif
                                                
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Featured product</h2>
                                        <div class="mb-3">
                                            <select name="is_featured" id="is_featured" class="form-control">
                                                <option {{ $product->is_featured == 'No' ? 'selected': ''}} value="No">No</option>
                                                <option {{ $product->is_featured == 'Yes' ? 'selected': ''}}  value="Yes">Yes</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>           
                                                            
                            </div>
                        
						
						<div class="pb-5 pt-3 col-md-12">
							<button type="submit" class="btn btn-success">Update</button>
							<button type="reset" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					


          </form>
         </div>
         </div>

@endsection


@section('customJs')
<script>

$('.related-product').select2({
    ajax: {
        url: '{{ route("product.getProducts") }}',
        dataType: 'json',
        tags: true,
        multiple: true,
        minimumInputLength: 3,
        processResults: function (data) {
            return {
                results: data.tags
            };
        }
    }
}); 

$("#productF").submit(function (event) 
{
    event.preventDefault();
    var formArray = $(this).serializeArray();
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{route("product.update",$product->id)}}',
        type:'put',
        data: formArray,
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true)
            {
                window.location.href="{{route('product.index')}}";
                $(".error").removeClass('invalid-feedback').html('');
            $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
            
            }
            else
            {
                var errors = response['errors'];

            //if(errors['title'])
            //{$("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['title']);}
            //else
            //{$("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");}


            $(".error").removeClass('invalid-feedback').html('');
            $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

            $.each(errors, function(key,value){
                $(`#${key}`).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);

            });
            }
            

        },error:function(jqXHR, exception){
            console.log("Something went wrong");
        }
    })
});

$("#title").change(function(){
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

$('#category').on('change', function () {
    $("#sub_category").attr('disabled', false); //enable subcategory select
    $("#sub_category").val("");
    $(".subcategory").attr('disabled', true); //disable all category option
    $(".subcategory").hide(); //hide all subcategory option
    $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
    $(".parent-" + $(this).val()).show(); 
});

Dropzone.autoDiscover = false;    
const dropzone = $("#image").dropzone({ 
    
    url:  "{{ route('product-images.update') }}",
    maxFiles: 10,
    paramName: 'image',
    params: {'product_id': '{{$product->id}}'},
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        //$("#image_id").val(response.image_id);
        //console.log(response)

       var html = `<div class="col-md-3" id="image-row-${response.image_id}"><div class="card">
       <input type="hidden" name="image_array[]" value="${response.image_id}">
        <img src="${response.ImagePath}" class="card-img-top" alt="">
        <div class="card-body">
            <a href="javascript:void(0)" onClick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
        </div>
        </div></div>`;

        $("#product_gallery").append(html);


    },complete : function(file){
        this.removeFile(file);
    }
});


function deleteImage(id){
    $("#image-row-"+id).remove();
if(confirm("Are you sure want to delete this image?"))
{
    $.ajax({
        url:'{{route("product-images.destroy")}}',
        type: 'delete',
        data: {id:id},
        success: function(response){
            if(response.status == true)
            {
                alert(response.message);
            }
            else
            {
                alert(response.message);
            }

        }

    });
}
}
</script>
@endsection