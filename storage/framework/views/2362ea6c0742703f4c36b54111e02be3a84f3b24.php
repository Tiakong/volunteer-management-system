<?php 
	session_start();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
	<link href="<?php echo e(asset('css/navstyle.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/common-style.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/event-style.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/event-form.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/program-table.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/program-style.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/program-form.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/search-style.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/navigation.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/shenghao.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/register-form.css')); ?>" rel="stylesheet">
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- Javascript -->
	<script src="<?php echo e(asset('js/app.js')); ?>"></script>
	<script src="<?php echo e(asset('js/script.js')); ?>"></script>
	<script src="<?php echo e(asset('js/event.js')); ?>"></script>
	<script src="<?php echo e(asset('js/common.js')); ?>"></script>
</head>

<body>
	<?php if(\Session::has('authority')): ?>
		<?php if(\Session::get('authority') == 'volunteer'): ?>
			<?php echo $__env->make('pop-up-navigation-volunteer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php elseif(\Session::get('authority') == 'admin'): ?>
			<?php echo $__env->make('pop-up-navigation-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="container" style="min-height: 100vh">
			<?php if(session()->has('message')): ?>
			<div class="alert alert-success">
				<?php echo e(session()->get('message')); ?>

			</div>
		<?php endif; ?>
		<?php echo $__env->yieldContent('container'); ?>
	</div>
	<?php echo $__env->make('footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>

<script src="<?php echo e(asset('js/nav.js')); ?>"></script>
</html>



