<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-bs-ride="carousel">



                    <div class="carousel-inner">
                        
                        @foreach($slide as $sl)
                        <?php $i=0; ?>

                        <div 
                        @if($i == 0)
                        class="carousel-item active"
                        @else
                        class="carousel-item"
                        @endif
                        >
                        
                           
                            <img class="d-block w-100" src="images/{{$sl->Hinh}}" alt="">
                        </div>
                        <?php $i++; ?>
                        @endforeach
                   
                        
                    </div>

                </div>
            </div>
</div>