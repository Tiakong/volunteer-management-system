<?php
use App\Common;
?>


<?php $__env->startSection('content'); ?>
<div class="text-center">
	<br/>
	<br/>
	<h1 align="center h3 mb-4">Data Export</h1>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('officework.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>