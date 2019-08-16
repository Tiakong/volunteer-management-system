<?php

use App\Common;

 ?>

 
 <?php $__env->startSection('content'); ?>


<div class="program-table">
                <table>
                    <tr>
                        <td><b>Name:</b></td>
                        <td>
                          <div>
                            <?php echo e($programme->name); ?>

                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Code:</b></td>
                        <td>
                          <div>
                            <?php echo e($programme->code); ?>

                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Duration:</b></td>
                        <td><div>  <?php echo e(Common::$Month[$programme->start_month]); ?> <?php echo " " ?><?php echo e($programme->start_year); ?>  <?php echo "-" ?>  <?php echo e(Common::$Month[$programme->end_month]); ?><?php echo " " ?><?php echo e($programme->end_year); ?>

                        </div></td>
                    </tr>

                    <tr>
                        <td><b>Venue:</b></td>
                        <td>
                          <div>
                            <?php echo e($programme->venue); ?>

                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Target: </b></td>
                        <td>
                          <div>
                            <?php echo e($programme->target); ?>

                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Contact: </b></td>
                        <td>
                          <div>
                            <?php echo e($programme->contact); ?>

                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Description:</b></td>
                        <td>
                          <div>
                            <?php echo e($programme->description); ?>

                          </div>
                        </td>
                    </tr>
                    <tr>
                      
                    </tr>
                    <td><b>Supporting Partners:</b></td>
                    <td>
                    <?php $__currentLoopData = $programmeImage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Storage::disk('public')->exists('cover_image/'.$image->filename)): ?>
                        
                            <img src ="/storage/cover_image/<?php echo e($image->filename); ?>" width="164" height="164"  style="margin:10px;">

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <tr>
                      <td></td>
                      <td>
						<button class='btn btn-primary'>
						  <a href='<?php echo e(route("programme.edit", $programme->pid)); ?>'>Edit</a>
						 </button>
						  <button class='btn  btn-danger'>
              <a href='<?php echo e(route("programme.delete", $programme->pid)); ?>'>Delete</a>
							</button>
                          </td>
                    </tr>
                </table>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('programme.master', ['title'=>'View Programme Details'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>