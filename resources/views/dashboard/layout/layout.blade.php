<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('user/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('user/css/paper-dashboard.css') }}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('user/css/demo.css') }}" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('user/css/themify-icons.css') }}" rel="stylesheet">

    <style>
    .element {
    display: inline-flex;
    align-items: center;
    }
    i.fa-camera {
    margin: 10px;
    cursor: pointer;
    font-size: 15px;
    }
    i.fa-video-camera {
    margin: 10px;
    cursor: pointer;
    font-size: 15px;
    }
    i.fa-file-text {
    margin: 10px;
    cursor: pointer;
    font-size: 15px;
    }
    i:hover {
    opacity: 0.6;
    }
    </style>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
        <p></br></p>
        <p></br></p>
        @yield('sidebar')
    </div>

    <div class="main-panel">
        
        @include('dashboard.nav.nav')

        <div class="content">
            @yield('content')
            
        </div>


       @include('dashboard.footer.footer')

    </div>

    <div class="right-sidebar">
        
    </div>
</div>
@if(empty(Auth::user()->username) || empty(Auth::user()->password))
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Update Profile</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('pass_update') }}" id="update_pass" method="POST">
            {{ csrf_field() }}
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <div class="alert alert-success print-success-msg" style="display:none">
                <span></span>
            </div></br>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="email" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Re-Password</label>
                <input type="password" name="re_password" class="form-control" id="exampleInputPassword1" placeholder="Re-Password">
            </div>
            <button type="button" id="submit_pass" class="btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Updating process">Submit</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif

</body>

    <!--   Core JS Files   -->
    <script src="{{ asset('user/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
	<script src="{{ asset('user/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{ asset('user/js/bootstrap-checkbox-radio.js') }}"></script>

	<!--  Charts Plugin -->
	{{-- <script src="{{ asset('user/js/chartist.min.js') }}"></script> --}}

    <!--  Notifications Plugin    -->
    <script src="{{ asset('user/js/bootstrap-notify.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="{{ asset('user/js/paper-dashboard.js') }}"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{ asset('user/js/demo.js') }}"></script>

    <script src="{{ asset('user/js/main.js') }}"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	//demo.initChartist();

        	

    	});
	</script>

    @if(empty(Auth::user()->username) || empty(Auth::user()->password))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#myModal').modal('show');
            });
        </script>       
    @endif

    <script>
        $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
        });
    </script>

</html>
