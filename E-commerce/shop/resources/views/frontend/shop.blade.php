@extends('frontend.layouts.app')
@section('content')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">            
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @if($cat->isNotEmpty())
                                @foreach($cat as $key=> $c)

                                <div class="accordion-item">
                                @if($c->subcat->isNotEmpty())
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$key}}" aria-expanded="false" aria-controls="collapseOne-{{$key}}">
                                                {{$c->name}}
                                            </button>
                                        </h2>
                                        @else

                                        <a href="{{route('front.shop',$c->slug)}}" class="nav-item nav-link {{($categorySelected == $c->id) ? 'text-primary' : ''}}">{{$c->name}}</a>

                                        @endif


                                        @if($c->subcat->isNotEmpty())
                                        <div id="collapseOne-{{$key}}" class="accordion-collapse collapse {{($categorySelected == $c->id) ? 'show' : ''}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div class="navbar-nav">
                                                
                                                @foreach($c->subcat as $sub)
                                                    <a href="{{route('front.shop',[$c->slug,$sub->slug])}}" class="nav-item nav-link {{($subCategorySelected == $sub->id) ? 'text-primary' : ''}}">{{$sub->name}}</a>
                                                @endforeach
                                                                                            
                                                </div>
                                            </div>
                                        </div>
                                        @endif 
                                </div>     
                                @endforeach
                            @endif           
                                                    
                            </div>
                            
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Brand</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            @if($brand->isNotEmpty())
                            @foreach($brand as $b)
                            <div class="form-check mb-2">
                                <input {{ (in_array($b->id,$brandsArray)) ? 'checked' : ''}} class="form-check-input brand-label" type="checkbox" value="{{$b->id}}" id="brand-{{$b->id}}" name="brand[]">
                                <label class="form-check-label" for="brand-{{$b->id}}">
                                    {{$b->name}}
                                </label>
                            </div>
                            @endforeach
                            @endif
                                
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                        <input type="text" class="js-range-slider" name="my_range" value="" />    
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                      
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="latest" {{ ($sort == 'latest') ?  'selected' :  ''}}>Latest</option>
                                        <option value="price_desc" {{ ($sort == 'price_desc') ?  'selected' :  ''}}>Price High</option>
                                        <option value="price_asc" {{ ($sort == 'price_asc') ?  'selected' :  ''}}>Price Low</option>
                                        

                                    </select>                            
                                </div>
                            </div>
                        </div>
                        @if($product->isNotEmpty())
                        @foreach($product as $p)
                        @php
                        $productImage = $p->productimage->first();
                        @endphp
                        <div class="col-md-4">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{route('front.product',$p->slug)}}" class="product-img">
                                    @if(!empty($productImage))
                                    <img class="card-img-top" src="uploads/product/small/{{$productImage->image}}" alt="">
                                    @else
                                    <img class="card-img-top" src="uploads/noimg.png" alt="">

                                    @endif
                                    </a>
                                    <a onClick="addToWishlist({{$p->id}})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>                            

                                    <div class="product-action">
                                        @if($p->track_qty == 'Yes')
                                        @if($p->qty >0)
                                        <a class="btn btn-dark" href="javascript:void(0);" onClick="addToCart({{$p->id}});">
                                            <i class="fa fa-shopping-cart" ></i> Add To Cart
                                        </a>  
                                        
                                        @else
                                        <a class="btn btn-dark" href="javascript:void(0);">
                                           Out of stock
                                        </a> 
                                        @endif
                                        @else
                                        
                                        <a class="btn btn-dark" href="javascript:void(0);" onClick="addToCart({{$p->id}});">
                                            <i class="fa fa-shopping-cart" ></i> Add To Cart
                                        </a> 
                                        @endif                          
                                    </div>
                                </div>                        
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="product.php">{{$p->title}}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>{{$p->price}} dong</strong></span>
                                        @if($p->compare_price > 0)
                                        <span class="h6 text-underline"><del>{{$p->compare_price}} dong</del></span>
                                        @endif
                                    </div>
                                </div>                        
                            </div>                                               
                        </div>  

                        @endforeach
                        @endif
                        

                        <div class="col-md-12 pt-5">
                            {{$product->withQueryString()->links()}}
                           <!-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')

<script>
    rangeSlider = $(".js-range-slider").ionRangeSlider({
        type: "double",
        min:1000,
        max:1000000,
        from: {{$priceMin}},
        step:10,
        to:{{$priceMax}},
        skin:"round",
        max_postfix: "+",
        postfix: " dong",
        onFinish: function(){
            apply_filters()
        }


    });

    var slider = $(".js-range-slider").data("ionRangeSlider");

    $(".brand-label").change(function(){

        apply_filters();

    }); 


    $("#sort").change(function(){
        apply_filters();

    }); 

    function apply_filters(){

        var brands = [];

        $(".brand-label").each(function(){

            if($(this).is(":checked") == true){

                brands.push($(this).val());

            }

        });


        var url = '{{ url()->current() }}?';

        
//brand filter
        if(brands.length >0)
        {
            url += '&brand='+brands.toString()

        }
//Price ranging
        url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;

//sorting

        var keyword= $("#search").val();
        if(keyword.length > 0)
        {
            url += '&search='+keyword;
        }
        url += '&sort='+$("#sort").val();


        window.location.href = url;


    }



</script>

@endsection

    

    


    

