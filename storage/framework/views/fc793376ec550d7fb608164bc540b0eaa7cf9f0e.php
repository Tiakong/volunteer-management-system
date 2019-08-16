<?php $__env->startSection('container'); ?>

<div class="container" >
<label for="name" style="text-align: center;font-size:50px;margin:200px;"><b>Welcome to CyberCare & Thanks for Joining Us!</b></label>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', ['title'=>'Register'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>