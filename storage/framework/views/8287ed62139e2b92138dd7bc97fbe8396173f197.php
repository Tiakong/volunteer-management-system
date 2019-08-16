<?php $__env->startSection('container'); ?>

<div class="content" >
                <div class="left-section">
                                <?php if(\Session::get('authority') == 'volunteer'): ?>
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
                                        <p>Number of Completed Events : <b><?php echo e($number_of_completed_events); ?></b></p>
                                        <p>Number of Completed Events in <b><?php echo e(date('Y',mktime(0,0,0,1,1,date("Y")))); ?></b> : <b><?php echo e($annual_completed_events); ?></b></p>
                                        </div>
                                </div>

                                <div class="main-section">
                                <div class="main-section-content">
                                <h1 class="sec03"><i class="fa fa-clock-o" style="margin-right: 10px;color:black;"></i>Serve Hours</h1>
                                <p>Number of Serve Hours : <b><?php echo e($lifetime_serve_hours); ?></b> hours</p>
                                <p>Number of Serve Hours <b><?php echo e(date('Y',mktime(0,0,0,1,1,date("Y")))); ?></b> :  <b><?php echo e($annual_serve_hours); ?></b> hours</p>
                                </div>
                </div>
                                    <?php elseif(\Session::get('authority') == 'admin'): ?>
                                <div class="programme-section">
                                        <div class="main-section-content">
                                                <h1 class="sec01"><i class="fa fa-calendar-plus-o" style="margin-right: 10px;color:black;"></i>Programmes</h1>
                                                        <?php $__currentLoopData = $programmes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $programme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="type-of-event">
                                                <p>Number of events in <?php echo e($programme->code); ?> : <b><?php echo e($number_of_events[$i]); ?></b></p>
                                                <div class="type-of-event-content">
                                                        <p>Completed : <b><?php echo e($number_of_completed_events[$i]); ?></b></p>
                                                </div>
                                                <div class="type-of-event-content">
                                                        <p>On going : <b><?php echo e($number_of_ongoing_events[$i]); ?></b></p>
                                                </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                </div>                    

                                <div class="volunteer-section" style="border:none;">
                                <div class="main-section-content">
                                <h1 class="sec03"><i class="fa fa-calendar-plus-o" style="margin-right: 10px;color:black;"></i>Volunteers</h1>
                                <p>Number of Registered Volunteers : <b><?php echo e(count($total_volunteers)); ?></b></p>
                                <p>Number of Active Volunteers : <b><?php echo e($active_volunteers); ?></b></p>
                                </div>
                        </div>
                </div>
                                <?php endif; ?>
<div class="right-section">
        <div class="ranking-section">
                <div class="main-section-content">
                        <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Lifetime Ranking</h1>
                                <table>
                                        <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Serve Hour</th>
                                        </tr>
                                        <?php if(count($lifetime_ranking)>0): ?>
                                                <?php $__currentLoopData = $lifetime_ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                                <td><?php echo e($i+1); ?></td>
                                                                <td><?php echo e($volunteer->name); ?></td>
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
                        <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Annual Ranking</h1>
                                <table>
                                        <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Serve Hour</th>
                                        </tr>
                                        <?php if(count($annual_ranking)>0): ?>
                                        <?php $i = 1?>
                                                <?php $__currentLoopData = $annual_ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer => $serve_hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                                <td><?php echo e($i); ?></td>
                                                                <td><?php echo e($volunteer); ?></td>
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
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', ['title'=>'Welcome to Volunteer Management System'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>