<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Email</title>
  </head>
  <body style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">
    <h1>Email từ khách hàng</h1>

    <p>Tên: {{$mailData['name']}}</p>
    <p>Email: {{$mailData['email']}}</p>
    <p>Subject: {{$mailData['subject']}}</p>

    <p>Tin nhắn:</p>
    <p>{{$mailData['message']}}</p>



  </body>
</html>