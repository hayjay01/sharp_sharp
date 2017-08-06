<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login / Register</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    {{-- <link rel="stylesheet" href="{{ asset('login/css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
    <style>
      .fa {
            padding: 10px;
            font-size: 15px;
            width: 20px;
            text-align: center;
            text-decoration: none;
        }

        /* Add a hover effect if you want */
        .fa:hover {
            opacity: 0.7;
        }

        /* Set a specific color for each brand */

        /* Facebook */
        .fa-facebook {
            background: #3B5998;
            color: white;
        }

        /* Twitter */
        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        /* Google */
        .fa-google {
            background: #dd4b39;
            color: white;
        }

        .fa-linkedin {
        background: #007bb5;
        color: white;
        }
    </style>
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Login / Registration Form</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    
    <div class="tooltip">Register</div>
  </div>
  <div class="form">
    <h2>Login to your account</h2>
    <div id="log" style="display:none">
        <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
        <span id="msg"></span>
    </div>
    <form id="login_form" method="POST" action="{{ route('user.login') }}">
    {{ csrf_field() }}
      <input type="text" name="username" placeholder="Username or Email"/>
      <input type="password" name="password" placeholder="Password"/>
      <button type="button" id="login_button">Login</button>
      <div id="loader" style="display: none;"><img src="{{ asset('loader.gif') }}"></div>
    </form></br>
    <a style="text-decoration: none;" href="#">Forgot your password?</a>
  </div>
  <div class="form">
    <div class="alert alert-danger print-error-msg" style="display:none"> 
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none">
        <span></span>
    </div></br>
    <h2>Create an account</h2>
    <form method="POST" id="register_form" action="{{ route('user.register') }}">
    {{ csrf_field() }}
	  <input type="text" name="name" placeholder="Name"/>
      <input type="text" name="username"  placeholder="Username"/>
      <input type="email" name="email" placeholder="Email Address"/>
      <input type="password" name="password" placeholder="Password"/>
      <input type="password" name="re_password" placeholder="Re-Password"/>
      <button type="button" id="register_button">Register</button>
      <div id="loader" style="display: none;"><img src="{{ asset('loader.gif') }}"></div>
    </form></br>
    <h3>Or Login with your social media</h3></br>
    <a href="#" class="fa fa-facebook"></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-google"></a>
    <a href="{{ route('social.auth', ['provider' => 'linkedin']) }}" class="fa fa-linkedin"></a>
  </div>
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
{{-- <script src='https://codepen.io/andytran/pen/vLmRVp.js'></script> --}}
    
{{-- <script src="{{ asset('login/js/bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('login/js/index.js') }}"></script>

</body>
</html>
