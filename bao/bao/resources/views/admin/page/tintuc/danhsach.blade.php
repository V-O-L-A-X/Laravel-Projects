@extends("admin.layout.master")
@section("content")
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if (session('thongbao'))
                        <div class="alert alert-success">
                    {{session('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu Đề</th>
                                <th>Tóm Tắt</th>
                                <th>Loại Tin</th>
                                <th>Số Lượt Xem</th>
                                <th>Nổi Bật</th>
                                <th colspan="2">Thao Tác</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td>{{$tt->TieuDe}}</td>
                                <td>{{$tt->TomTat}}</td>
                                <td>{{$tt->Loaitin->Ten}}</td>
                                <td>{{$tt->SoLuotXem}}</td>
                                <td>{{$tt->NoiBat}}</td>
                                
                                <td class="center"> <a class="btn btn-success" href="{{route('tintuc.edit', $tt->id)}}"><i class="fa fa-pencil fa-fw"></i>Sửa</a></td>
                                <td class="center">
                                    <form action="{{route('tintuc.destroy',$tt->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i>Xoá</button>
                                    </form>
                                    
                                
                                </td>

                        
                            </tr>
                        @endforeach
                        </tbody> 
                    </table>
                    {{$tintuc->links()}}
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection