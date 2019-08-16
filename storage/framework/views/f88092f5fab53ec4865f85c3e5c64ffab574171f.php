<?php $__env->startSection('container'); ?>
<?php if(Session::get('authority')=='volunteer' || Session::get('authority')=='admin'): ?>
<div class="content" >
<?php if($authority == 'volunteer'): ?>
                <div class="left-section">
                                
                                <div class="main-section">
                                        <div class="main-section-content">
                                                <h1 class="sec01"><i class="fa fa-shield" style="margin-right: 10px;color:black;"></i>Rank</h1>
                                                        <?php if($volunteer_rank == null): ?>
                                                                <h1 style="font-size:80px;">Bronze</h1>
                                                        <?php else: ?>
                                                                <h1 style="font-size:80px;">$volunteer_rank</h1>
                                                        <?php endif; ?>

                                         </div>
                                </div>

                                <div class="main-section">
                                        <div class="main-section-content">
                                                <h1 class="sec02"><i class="fa fa-list-alt" style="margin-right: 10px;color:black;"></i>Events</h1>
                                                <p>Number of Reserved Events : <b><?php echo e($number_of_reserved_events); ?></b></p>
                                                <p>Number of Total Completed Events : <b><?php echo e($number_of_attended_events); ?></b></p>
                                                <p>Number of Completed Events(<?php echo e(date('Y',mktime(0,0,0,1,1,date("Y")))); ?>) : <b><?php echo e($annual_completed_events); ?></b></p>
                                        </div>
                                </div>

                                <div class="main-section">
                                        <div class="main-section-content">
                                                <h1 class="sec03"><i class="fa fa-clock-o" style="margin-right: 10px;color:black;"></i>Served Hours</h1>
                                                <p>Number of Total Served Hours : <b><?php echo e($lifetime_serve_hours); ?></b> hours</p>
                                                <p>Number of Served Hours(<?php echo e(date('Y',mktime(0,0,0,1,1,date("Y")))); ?>) :  <b><?php echo e($annual_serve_hours); ?></b> hours</p>
                                        </div>
                                 </div>
                               
                </div>
                                
        <div class="right-section">
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Cybercare Leaderboard</h1>
                                        <table>
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                <?php if(count($lifetime_ranking)>0): ?>
                                                        <?php $__currentLoopData = $lifetime_ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                        <td><?php echo e($i+1); ?></td>
                                                                        <td><?php echo e($volunteer->name); ?></td>
                                                                        <td><?php echo e($volunteer->occupation); ?></td>
                                                                        <td><?php echo e($volunteer->acc_serve_hour); ?></td>
                                                                </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                        <?php endif; ?>
                                        </table>
                        </div>
                </div>
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Annual Leaderboard(<?php echo e(date('Y')); ?>)</h1>
                                        <table>
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                <?php if(count($annual_ranking)>0): ?>
                                                <?php $i = 1?>
                                                        <?php $__currentLoopData = $annual_ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer => $serve_hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                        <td><?php echo e($i); ?></td>
                                                                        <td><?php echo e($volunteer); ?></td>
                                                                        <td><?php echo e($name_occupation[$volunteer]); ?></td>
                                                                        <td><?php echo e($serve_hour); ?></td>
                                                                </tr>
                                                                <?php $i += 1?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                        <?php endif; ?>
                                        </table>
                        </div>
                </div>
        </div>
        <?php else: ?>
        <div class="right-section" style="width:100%;">
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Cybercare Leaderboard</h1>
                                        <table class="admin-table">
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                <?php if(count($lifetime_ranking)>0): ?>
                                                        <?php $__currentLoopData = $lifetime_ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                        <td><?php echo e($i+1); ?></td>
                                                                        <td><?php echo e($volunteer->name); ?></td>
                                                                        <td><?php echo e($volunteer->occupation); ?></td>
                                                                        <td><?php echo e($volunteer->acc_serve_hour); ?></td>
                                                                </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                        <?php endif; ?>
                                        </table>
                        </div>
                </div>
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Annual Leaderboard(<?php echo e(date('Y')); ?>)</h1>
                                        <table  class="admin-table">
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                <?php if(count($annual_ranking)>0): ?>
                                                <?php $i = 1?>
                                                        <?php $__currentLoopData = $annual_ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer => $serve_hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                        <td><?php echo e($i); ?></td>
                                                                        <td><?php echo e($volunteer); ?></td>
                                                                        <td><?php echo e($name_occupation[$volunteer]); ?></td>
                                                                        <td><?php echo e($serve_hour); ?></td>
                                                                </tr>
                                                                <?php $i += 1?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                        <?php endif; ?>
                                        </table>
                        </div>
                </div>
        </div>
        <?php endif; ?>
</div>

<?php else: ?>
<script>
 window.location.href = '<?php echo e(route("auth")); ?>';
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', ['title'=>'Welcome to Volunteer Management System'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>