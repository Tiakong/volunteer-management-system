<?php

use App\Common;
?>


<?php $__env->startSection('container'); ?>



<style>
fieldset
	{
		border: 1px solid #ddd !important;
		margin-top:3%;
		margin-left: auto;
		margin-right:auto;
		xmin-width: 0;
		padding: 10px;
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}

		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px;
			width: 35%;
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px 5px 5px 10px;
			background-color: #ffffff;
    }
</style>
<?php echo $__env->make('common.show-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="panel-body" >

<form id="password-form" name='password' method="post" action="<?php echo e(route('volunteer.update_password')); ?>">

      <?php echo e(csrf_field()); ?>

      <div class="form-group row">
<fieldset class="col-md-9 " >    	
                        <legend>Password</legend>
                        <div class="panel panel-default">
                          <div class="panel-body">
                          <div class="form-group row">
                              <?php echo Form::label('old_password', 'Current Password', [
                                'class' => 'control-label col-sm-4',
                              ]); ?>

                              <div class="col-sm-5">
                                <input type="password" name="old_password" class="form-control mb-4" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <?php echo Form::label('new_password', 'New Password', [
                                'class' => 'control-label col-sm-4',
                              ]); ?>

                              <div class="col-sm-5">
                                <input type="password" name="new_password" class="form-control mb-4" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <?php echo Form::label('new_password_confirmation', 'Confirm Password', [
                                'class' => 'control-label col-sm-4',
                              ]); ?>

                              <div class="col-sm-5">
                                <input type="password" name="new_password_confirmation" class="form-control mb-4" />
                              </div>
                            </div>
                          </div>
                        </div>
                    </fieldset>	
                     </div>
                     <div class="col-sm-11" style="text-align:center;">	
                        <input type="submit" value="Update" class="btn btn-primary" >
                        <button onClick=""class="btn btn-danger" >Cancel</button>
                      </div>
                      </div>
                    </form>
                    </div>

                    <script>
    var msg = '<?php echo e(Session::get('alert')); ?>';
    var exist = '<?php echo e(Session::has('alert')); ?>';
    if(exist){
      alert(msg);
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', ['title'=>'Change Password'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>