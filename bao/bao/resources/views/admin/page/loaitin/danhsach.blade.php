@extends("admin.layout.master")
@section("content")
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại Tin
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
                                <th>Tên</th>
                                <th>Tên không dấu</th>
                                <th>Thể Loại</th>
                                <th>Sửa</th>
                                <th>Xoá</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($loaitin as $lt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$lt->id}}</td>
                                <td>{{$lt->Ten}}</td>
                                <td>{{$lt->TenKhongDau}}</td>
                                <td>{{$lt->Theloai->Ten}}</td>
                                <td class="center"> <a class="btn btn-success" href="{{route('loaitin.edit', $lt->id)}}"><i class="fa fa-pencil fa-fw"></i>Sửa</a></td>
                                <td class="center">
                                <form action="{{route('loaitin.destroy',$lt->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i>Xoá</button>
                                </form>
                                </td>

                        
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                 
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection