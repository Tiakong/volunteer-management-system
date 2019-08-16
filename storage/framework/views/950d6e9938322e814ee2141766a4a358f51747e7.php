<?php
use App\Common;
?>


<?php $__env->startSection('content'); ?>
<div class="col-sm-12 text-center">
	<br/>
	<?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<br/>
	
	<button class='btn btn-primary'>
		<strong><a href="<?php echo e(route('officework.create')); ?>">Record</a></strong>
	</button>
	
	<br/>
	<div class="form-group p-3">
		<table class="table table-hover table-striped table-bordered">
			<col width="5%">
			<col width="50%">
			<col width="12%">
			<col width="13%">
			<col width="10%">
			<thead class="black white-text">
				<tr>
					<th>No.</th>
					<th>Description</th>
					<th>Serve Hour</th>
					<th>Record Date</th>
					<th></th>
				</tr>
			 </thead>
			 <tbody>
				<?php $__currentLoopData = $officeworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($loop->index+1); ?></td>
					<td><?php echo e($row->description); ?></td>
					<td><?php echo e($row->serve_hour); ?></td>
					<td><?php echo e($row->created_at->format('d M Y')); ?></td>
					<td><a href="<?php echo e(route('officework.show', $row->oid)); ?>">See More</a></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('officework.master', ['title'=>"Index of Voluntary Administrative Works"], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>