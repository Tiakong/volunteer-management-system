<header class="main_h">
	<?php if((Session::get('authority')) == 'volunteer'): ?>
		<?php echo $__env->make('navigation-volunteer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif((Session::get('authority')) == 'admin'): ?>
        <?php echo $__env->make('navigation-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
</header>

<div class="company">
    <ul class="left-info">
        <li class="hidden-xs">Welcome to CyberCare Youth Organisation. We are ready to assist you with your inquiries. </li>
        <li><i class="material-icons" style="font-size:15px;color:rgb(248, 248, 248);">mail</i></li>
        <li>  cyo@cybercare.org.my </li>
        <li>|</li>
        <li><i class="material-icons" style="font-size:15px;color:rgb(248, 248, 248);">home</i></li>
        <li> Kuala Lumpur , Malaysia.</li>
    </ul>
    <ul class="right-info hidden-xs">
        <li><a href="https://plus.google.com/105938260003540934580" target="_blank"><i class="fa fa-google-plus"  style="font-size:15px; color:rgb(248, 248, 248);"></i></a></li>
        <li><a href="https://www.instagram.com/cybercare_youth/" target="_blank"><i class="fa fa-instagram"  style="font-size:15px; color:rgb(248, 248, 248);"></i></a></li>
        <li><a href="https://twitter.com/CyberCare_Youth" target="_blank"><i class="fa fa-twitter"  style="font-size:15px; color:rgb(248, 248, 248);"></i></a></li>
        <li><a href="https://www.facebook.com/CyberCareKL" target="_blank"><i class="fa fa-facebook"  style="font-size:15px; color:rgb(248, 248, 248);"></i></a></li>
    </ul>
</div>

<div class="top-container">
	<?php if((Session::get('authority')) == 'volunteer'): ?>
		<?php echo $__env->make('navigation-volunteer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif((Session::get('authority')) == 'admin'): ?>
		<?php echo $__env->make('navigation-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
    <div class="title">
		<p><?php echo e($title); ?></p>
    </div>
</div>



