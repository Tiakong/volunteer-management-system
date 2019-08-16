
<?php if(count($errors) > 0): ?>
<div class="text-left alert alert-danger alert-dismissible fade show">
	<strong>Errors occured!</strong>
	<ul>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li><?php echo e($error); ?></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>	
	</button>
</div>
<?php endif; ?>

<?php if(Session::has('success')): ?>
<div class="text-left alert alert-success alert-dismissible fade show">
	<strong><?php echo e(Session::get('success')); ?></strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>	
	</button>
</div>
<?php elseif(Session::has('fail')): ?>
<div class="text-left alert alert-danger alert-dismissible fade show">
	<strong><?php echo e(Session::get('fail')); ?></strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>	
	</button>
</div>
<?php endif; ?>
