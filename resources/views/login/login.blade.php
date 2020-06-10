<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('public/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/theme/dist/css/adminlte.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/c/cc/Danau_Toba_dari_Samosir.jpg'); background-repeat: round;">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>TAROMBO</b>BATAK</a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <form action="{{route ('Home.loginApi') }}" method="get">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            {!! NoCaptcha::renderJs() !!}
            {!! app('captcha')->display(); !!}
          </div>
        </div><br>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
     
    </div>
  </div>

<script src="{{asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/theme/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/theme/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
