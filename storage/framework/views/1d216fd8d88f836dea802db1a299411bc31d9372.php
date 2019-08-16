<?php $__env->startSection('container'); ?>
<div class='col-sm-9'>
	<br>
	<?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</br>
	<form name='submitForm' method='post' class='text-right' action='<?php echo e(url("login-validate")); ?>'>
		<?php echo e(csrf_field()); ?>

		<div id='username'>
			<div class='p-3 row'>
				<?php echo Form::label('email', 'Email:', [
					'class' => 'control-label col-sm-3 p-2',
				]); ?>

				<div class="col-sm-9">
					<input name='username' type='text' class='form-control' placeholder='email' />
				</div>
			</div>
		</div>
		<div id='password'>
			<div class='p-3 row'>
				<?php echo Form::label('password', 'Password:', [
					'class' => 'control-label col-sm-3 p-2',
				]); ?>

				<div class="col-sm-9">
					<input name='password' type='password' onkeydown='Submit(event)' class='form-control' placeholder='password' />
				</div>
			</div>
		</div>
	</form>
	<div class='text-center p-2'>
		<button id='submitBtn' style='margin:8px;width:25%;' class='p-3 btn btn-primary' onclick='SubmitForm()'>Login</button>
		<p style='margin:8px;' >Don't have an <a href='<?php echo e(route("register")); ?>'>account</a>?</p>
	</div>
</div>

<script>
function Submit(e)
{
	console.log(e);
	//If enter key was pressed
	if(e.keyCode == 13)
		document.getElementById('submitBtn').click();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', ['title'=>'Login'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>