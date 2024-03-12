<div class="container ">
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body " data-bs-theme="dark">
  <div class="container-fluid">

    <a class="navbar-brand fs-1" href="#">Báo</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('trangchu')}}">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('gioithieu')}}">Giới thiệu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('lienhe')}}">Liên Hệ</a>
        </li>



        </ul>
        <ul class="navbar-nav me-2 mb-2 mb-lg-0">

        <li>

        <form class="d-flex" role="search" action="{{route('timkiem')}}" method="POST">
        @csrf

        <div class="form-group me-2 mt-4">
          <input class="form-control me-2" type="search" placeholder="Search" name="tukhoa" >
        </div>
        <button class="btn btn-outline-success" type="submit">Tìm</button>
        </form>

        </li>

        <li class="nav-item btn btn-outline-success mb-2 me-2">

          @if(Auth::check())
 
                        <a href="{{ route('nguoidung') }}" class="nav-link">
                            <span class="glyphicon glyphicon-user"></span>
                            {{Auth::user()->name}}
                        </a>
          </li>
          <li class="nav-item btn btn-outline-danger mb-2 me-2">
            <a href="{{route('dangxuat')}}" class="nav-link">Đăng xuất</a>
          </li>
                        

                   @else


          <a href="{{route('dangky')}}" class="nav-link ">Đăng Ký</a>





        </li>
        <li class="nav-item btn btn-outline-warning mb-2">
        <a href="{{route('dangnhap')}}" class="nav-link">Đăng Nhập</a>
        </li>
        @endif
      </ul>

    </div>

</nav>
</div>