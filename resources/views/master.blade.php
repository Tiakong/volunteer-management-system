<?php 
	session_start();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<meta charset="UTF-8">
	<title>Volunteer Management System</title>
	
	<!-- BootStrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat|Cardo' rel='stylesheet' type='text/css'>

	<!-- CSS -->
	<link href="{{ asset('css/navstyle.css') }}" rel="stylesheet">
	<link href="{{ asset('css/common-style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/event-style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/event-form.css') }}" rel="stylesheet">
	<link href="{{ asset('css/program-table.css') }}" rel="stylesheet">
	<link href="{{ asset('css/program-style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/program-form.css') }}" rel="stylesheet">
	<link href="{{ asset('css/search-style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
	<link href="{{ asset('css/shenghao.css') }}" rel="stylesheet">
	<link href="{{ asset('css/register-form.css')}}" rel="stylesheet">
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- Javascript -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>
	<script src="{{ asset('js/event.js') }}"></script>
	<script src="{{ asset('js/common.js') }}"></script>
</head>

<body>
	@if (\Session::has('authority'))
		@if(\Session::get('authority') == 'volunteer')
			@include('pop-up-navigation-volunteer')
		@elseif(\Session::get('authority') == 'admin')
			@include('pop-up-navigation-admin')
		@endif
	@endif
	
	@include('header')
	<div class="container" style="min-height: 100vh">
			@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@endif
		@yield('container')
	</div>
	@include('footer')
</body>

<script src="{{ asset('js/nav.js') }}"></script>
</html>



