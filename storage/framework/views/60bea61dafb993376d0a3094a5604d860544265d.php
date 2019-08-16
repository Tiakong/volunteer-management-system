<?php
use App\Common;
?>


<?php $__env->startSection('content'); ?>
<div class='text-center col-sm-12'>
	<br/>
	<?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<br/>
	<a href="<?php echo e(route('notification.index')); ?>"><button class='btn btn-primary'>Back</button></a>
	
	<div class='p-5 text-right'>
		<div class="form-group row">
			<?php echo Form::label('notification-title', 'Title', [
				'class' => 'control-label col-sm-2',
			]); ?>

			<div class='col-sm-10 text-left'>
				<p><?php echo $notification->title?></p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo Form::label('notification-description', 'Description', [
				'class' => 'control-label col-sm-2',
			]); ?>

			<div class='col-sm-10 text-left'>
				<pre><?php echo $notification->description?>
				</pre>
			</div>
		</div>
		<div class="form-group row">
			<?php echo Form::label('employee-name', 'Category', [
				'class' => 'control-label col-sm-2',
			]); ?>

			<div class='col-sm-10 text-left'>
				<p><?php echo e(Common::$NotificationCategory[$notification->category]); ?></p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo Form::label('employee-name', 'Created by', [
				'class' => 'control-label col-sm-2',
			]); ?>

			<div class='col-sm-10 text-left'>
				<p><?php echo e($notification->created_by); ?></p>
			</div>
		</div>
	</div>
	<?php if(Session::get('authority') == 'admin'): ?>
	<a class='p-2' href="<?php echo e(route('notification.edit', $notification->nid)); ?>">
		<button class="btn btn-lg btn-block btn-primary"><b>Edit</b></button>
	</a>
	<button onclick='return ConfirmDelete("<?php echo route("notification.delete", $notification->nid)?>")' class="p-2 btn btn-lg btn-block btn-danger"><b>Delete</b></button>
	<?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('notification.master', ['title'=>'Notification Detail'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>