<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password Email</title>
  </head>
  <body style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">
  
  <p>Hello, {{$formData['user']->name}} </p>
  <h1>Bạn đã yêu cầu đổi mật khẩu</h1>

  <p>Bấm vào đường link bên dưới để cập nhật lại mật khẩu</p>

  <a href="{{route('front.resetPassword',$formData['token'])}}">Bấm vào đây</a>
  <p>Thanks!</p>
  </body>
</html>