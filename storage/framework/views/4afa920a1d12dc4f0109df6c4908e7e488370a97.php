
	<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger">
		<ul>
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<?php endif; ?>
	
	<?php if(Session::has('success')): ?>
	<div class="alert alert-success">
		<p><?php echo e(Session::get('success')); ?></p>
	</div>
	<?php elseif(Session::has('fail')): ?>
	<div class="alert alert-danger">
		<p><?php echo e(Session::get('fail')); ?></p>
	</div>
	<?php endif; ?>