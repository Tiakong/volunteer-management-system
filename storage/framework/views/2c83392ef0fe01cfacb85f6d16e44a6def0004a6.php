<?php
use App\Common;
?>


<?php $__env->startSection('content'); ?>
<div class="col-sm-12 text-center">
	<br/>
	<?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<br/>
	<div class='p-5'>
		<div class="form-group row">
			<?php echo Form::label('officework-description', 'Description', [
				'class' => 'control-label col-sm-4',
			]); ?>

			<p class="col-sm-6 text-left"><?php echo $officework->description?></p>
		</div>
		<div class="form-group row">
			<?php echo Form::label('officework-serve-hour', 'Serve Hour', [
				'class' => 'control-label col-sm-4',
			]); ?>

			<p class="col-sm-6 text-left"><?php $minutes = $officework->serve_hour*60; echo floor($minutes/60) ?> hour <?php echo $minutes%60?> minute</p>
		</div>
		<div class="form-group row">
			<?php echo Form::label('employee-name', 'Created by', [
				'class' => 'control-label col-sm-4',
			]); ?>

			<p class="col-sm-6 text-left"><?php echo $officework->created_by?></p>
		</div>
		<div class="border border-light p-3">
			<h3>Volunteer list:</h3>
			<div class="text-left p-3" style="display:inline-block">
				<table id="volunteer_list" class="table table-hover table-striped table-bordered text-center">
					<col width="10%">
					<col width="30%">
					<col width="30%">
					<col width="15%">
					<col width="15%">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Remark</th>
						<th>Serve Hour</th>
						<th></th>
					</tr>
					<?php $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($row->id); ?></td>
						<td class='text-left'><?php echo e($row->name); ?></td>
						<td class='text-left'><?php echo e($row->remark); ?></td>
						<td><?php echo e($row->serve_hour); ?></td>
						<td><a href="<?php echo e(route('volunteer.get-volunteer',['id'=> $row->vid])); ?>">View Profile<a/></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</table>
			</div>
		</div>
	</div>
	<div class='p-5'>
		<a class='p-1' href="<?php echo e(route('officework.edit', $officework->oid)); ?>">
			<button class="btn btn-lg btn-block btn-primary"><b>Edit</b></button>
		</a>
		<button onclick='return ConfirmDelete("<?php echo route("officework.delete", $officework->oid)?>")' class="p-2 btn btn-lg btn-block btn-danger"><b>Delete</b></button>
	</div>
</div>

<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('officework.master', ['title'=>"Voluntary Administrative Work Info"], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>