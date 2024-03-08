@extends("admin.layout.master")
@section("content")
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Thông tin người dùng
<small>Xem Thông Tin</small>
</h1>
</div>
<!--/.col-lg-12-->
<div class="col-lg-7" style="padding-bottom:120px">
<form action="" method="POST">
<div class="form-group">
<label>Họ và Tên</label>
<input class="form-control" name="txtUser" value="{{$user->name}}" disabled />
</div>
<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="txtEmail" value="{{$user->email}}" />
</div>
<div class="form-group">
<label>Quyền</label>
<label class="radio-inline">
<input type="radio" name="rdoLevel" value="1" {{($user->quyen==1)?"checked":""}} type="radio">
Quản trị
</label>
<label class="radio-inline">
<input name="rdoLevel" value="0" {{($user->quyen==0)?"checked":""}} type="radio">Thành viên
</label>
</div>
<a href="{{route('theloai.index')}}" class="btn btn-primary">Trở về</a>
</form>
</div></div>
<!--/.row-->
</div>
<!--.container-fluid-->
</div>
@endsection
