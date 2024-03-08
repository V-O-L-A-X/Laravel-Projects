@extends("frontend.layouts.master")
@section("content")
    <!-- Page Content -->
<div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span>Posted on {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $tintuc->NoiDung !!}</p>
                

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Auth::check())
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="{{route('binhluan',$tintuc->id)}}" method="POST" role="form">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="noidung"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>

                <hr>
                @endif

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $cm)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->user->name}}
                            <small>{{$cm->created_at}}</small>
                        </h4>
                        {{$cm->NoiDung}}
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="row mt-5">
            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading fs-2"><b>Tin liên quan</b></div>
                    <div class="panel-body p-2">

                        <!-- item -->
                        @foreach($tinlienquan as $tlq)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                                <a href="{{route('tintuc',[$tlq->id, $tlq->TieuDeKhongDau])}}">
                                    <img class="img-responsive" src="images/{{$tlq->Hinh}}" alt="" width="200">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <a href="{{route('tintuc',[$tlq->id, $tlq->TieuDeKhongDau])}}" class="fs-4"><b>{{$tlq->TieuDe}}</b></a>
                                <p style="padding:5px;text-align:justify;font-weight: normal;">{!! $tlq->TomTat !!}</p>
                            </div>
                            
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach


                    </div>
                </div></div>
                <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading fs-2"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinnoibat as $tnb)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                                <a href="{{route('tintuc',[$tnb->id, $tnb->TieuDeKhongDau])}}">
                                    <img class="img-responsive" src="images/{{$tnb->Hinh}}" alt="" width="200">
                                </a>
                            </div>
                            <div class="col-md-8">
                            <a href="{{route('tintuc',[$tnb->id, $tnb->TieuDeKhongDau])}}" class="fs-4"><b>{{$tnb->TieuDe}}</b></a>
                            <p style="padding-left:5px;text-align:justify;font-weight: normal;">{!! $tnb->TomTat !!}</p>
                            </div>
                            
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach






                    </div>
                </div>

            </div>

        </div></div>
        <!-- /.row -->
</div>
    <!-- end Page Content -->
@endsection