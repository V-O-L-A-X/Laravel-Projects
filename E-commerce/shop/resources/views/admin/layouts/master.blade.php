<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Admin Panel</title>
  <base href="{{asset('')}}">
  <!-- loader-->
  <link href="adminstyle/assets/css/pace.min.css" rel="stylesheet"/>
  <script src="adminstyle/assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="adminstyle/assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->

  <!-- simplebar CSS-->
  <link href="adminstyle/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="adminstyle/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="adminstyle/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="adminstyle/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="adminstyle/assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="adminstyle/assets/css/button-slide.css" rel="stylesheet"/>

  <link href="adminstyle/assets/css/app-style.css" rel="stylesheet"/>
  <link href="adminstyle/select2/css/select2.min.css" rel="stylesheet"/>
  <link href="adminstyle/datetime/datetimepicker.css" rel="stylesheet"/>

  

   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

   <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


   <meta name="csrf-token" content="{{csrf_token()}}">
  
  
</head>

<body class="bg-theme bg-theme4">
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   @include('admin.layouts.menu')
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
@include('admin.layouts.header')
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">


<!--Start Dashboard Content-->

@yield('content')
<!--End content-wrapper--></div>
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2018 Dashtreme Admin
        </div>
      </div>
    </footer>
	<!--End footer-->
	
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script src="adminstyle/assets/js/popper.min.js"></script>
  <script src="adminstyle/assets/js/bootstrap.js"></script>
  <script src="adminstyle/assets/js/bootstrap.min.js"></script>
	
 <!-- simplebar js -->

  <script src="adminstyle/assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="adminstyle/assets/js/sidebar-menu.js"></script>
  <!-- loader scripts -->

  <!-- Custom scripts -->
  <script src="adminstyle/assets/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="adminstyle/assets/plugins/Chart.js/Chart.min.js"></script>
  <script src="adminstyle/select2/js/select2.min.js" rel="stylesheet"></script>
 
  <!-- Index js -->
  <script src="adminstyle/assets/js/index.js"></script>
  <script src="adminstyle/datetime/datetimepicker.js"></script>

  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>





  <script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>


  @yield('customJs')
</body>
</html>
