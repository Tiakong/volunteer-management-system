<?php
use App\Common;
?>


<?php $__env->startSection('content'); ?>
<div class='text-center col-sm-12'>
	<br/>
	<?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<br/>
	<?php if(Session::get('authority')=='admin'): ?>
	<a href='<?php echo e(route("notification.create")); ?>'><button class='btn btn-primary'>Send Notification</button></a>
	<?php endif; ?>
	<br/>
	<!--Broadcast Notification-->
	<div class='card text-left' style="height:300px;overflow-y:scroll;overflow-x:hidden;border:1px solid black;margin-top:10px;display:block;">
		<div class='row card-body'>
			<h3 class='text-center' style='margin:0 auto;margin-top:10px;margin-bottom:15px;'>Broadcast Notification</h3>
			<table class="table table-striped table-bordered text-left disable-highlight">
				<col width="5%">
				<col width="70%">
				<col width="25%">
				<?php $__currentLoopData = $broadcastnotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<thead class="black white-text notification-title">
					<tr class="<?php echo e(Common::$NotificationCategory[$row->category]); ?>">
						<td class='text-center'><?php echo e($loop->index+1); ?></td>
						<td><?php echo e($row->title); ?></td>
						<td><?php echo e(Carbon\Carbon::parse($row->created_at)->format('d M Y')); ?></td>
					</tr>
				</thead>
				<tbody class='notification-description'>
					<tr>
						<td colspan=3>
							<pre><?php echo strlen($row->description)>200?substr($row->description,0, 197).'...':$row->description?></pre>
						</td>
					</tr>
					<tr>
						<td colspan=2>Created by <?php echo e($row->created_by); ?></td>
						<td class='text-center'><a href="<?php echo e(route('notification.show', $row->nid)); ?>">See More</a></td>
					</tr>
				</tbody>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
	</div>
	
	<!--Normal Notification-->
	<div class='p-5 text-left' style='display:block;'>
		<?php echo e($notifications->links('common.pagination')); ?>

		<table class="notification-table table table-bordered disable-highlight">
			<col width="5%">
			<col width="75%">
			<col width="20%">
			<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<thead class="white-text notification-title">
				<tr class="<?php echo e(Common::$NotificationCategory[$row->category]); ?>">
					<td class='text-center'><?php echo e($loop->index+1+($notifications->currentPage()-1)*$notification_per_page); ?></td>
					<td><?php echo e($row->title); ?></td>
					<td class='text-center'><?php echo e(Carbon\Carbon::parse($row->created_at)->format('d M Y')); ?></td>
				</tr>
			</thead>
			<tbody class='notification-description'>
				<tr>
					<td colspan=3>
						<pre><?php echo strlen($row->description)>200?substr($row->description,0, 197).'...':$row->description?></pre>
					</td>
				</tr>
				<tr>
					<td colspan=2>Created by <?php echo e($row->created_by); ?></td>
					<td class='text-center'><a href="<?php echo e(route('notification.show', $row->nid)); ?>">See More</a></td>
				</tr>
			</tbody>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
		<?php echo e($notifications->links('common.pagination')); ?>

	</div>
</div>

<script>
$('.notification-title').click(function(){
	$(this).next('.notification-description').toggleClass('row-active');	//$(this).next('.notification-description').slideToggle('fast');
});
function send()
{
	SendNotification(
		"<?php echo route('notification.send'); ?>",
		1,
		'Auto Notification',
		'Auto Notification',
		null,
		0,
		0
	);
}

function SetDescription(dom)
{
	
}
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('notification.master', ['title'=>"Your Notifications"], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>