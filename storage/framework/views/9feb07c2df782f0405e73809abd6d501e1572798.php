<?php $__env->startSection('container'); ?>
<?php if(Session::get('authority')=='volunteer' || Session::get('authority')=='admin'): ?>
<?php echo $__env->yieldContent('content'); ?>
<?php else: ?>
<script>
 window.location.href = '<?php echo e(route("auth")); ?>';
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master',['title'=>$title], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>