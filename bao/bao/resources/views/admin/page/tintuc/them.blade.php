@extends("admin.layout.master")
@section("content")
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Thêm Mới</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                            </div>
                    @else
                        @if (session('thongbao'))
                        <div class="alert alert-success">
                        {{session('thongbao')}}
                        </div>
                        @endif
                    @endif

                    <form action="{{route('tintuc.store')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    @csrf
                
            <!--  <div class="form-group">  
                        <label>Thể Loại</label>                      
                        <select class="form-control main" name="theloai">
                            @foreach($theloai as $tl)
                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div> 
            -->
                    <div class="form-group">                         
                        <label>Loại Tin</label>
                        <select class="form-control sub" name="loaitin">
                            @foreach($loaitin as $lt)
                            <option  value="{{$lt->id}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="form-group"> 
                        <label>Tiêu đề</label>
                        <input class="form-control" name="tieude"/>
                    </div>

                    <div class="form-group"> 
                        <label>Tóm tắt</label>
                        <textarea name="tomtat" row="3" class="form-control ckeditor"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="noidung" row="3" class="form-control ckeditor"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinh"/>
                    </div>

                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input type="radio" name="noibat" value="0" checked>Không 
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="noibat" value="1" checked>Có
                        </label>
                    </div>
                            
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                    <div class="col-lg-4">
                    <ul class="list-group text-center">
                        <li class="list-group-item active h3">Danh sách các nhóm thể loại</li>
                        @foreach($theloai as $tl)
        
                        @if(count($tl->loaitin)>0)
                        <li href="#" class="list-group-item list-group-item-danger ">
                            {{{$tl->Ten}}}
                        </li>

                        @foreach($tl->loaitin as $lt)
                        <li class ="list-group-item">
                            <div>{{$lt->Ten}}</div>

                        
                        </li>
                        @endforeach

                        @endif
                    @endforeach
                    </ul>
                    </div>
            </div>
                <!-- /.row -->
    </div>
            <!-- /.container-fluid -->
</div>

@endsection

@section("script")
    <script>
        $(document).ready(function(){
            $("#theloai").change(function(){
            var idtl = $(this).val();
            console.log(idtl);
            $.get("admin/ajax/loaitin/"+idtl, function(data){
            $("#loaitin").html(data);
            });
            });
        });
    </script>

    
@endsection