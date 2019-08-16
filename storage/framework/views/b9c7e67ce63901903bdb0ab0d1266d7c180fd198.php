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

    input[type="text"]:disabled {
  background: #fafafa;
    }
  
    .profile-img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 100px;
  margin-left:auto;
  margin-right:auto;
  margin-top:50px;
}

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
}

</style>
  <div class="register_container" >

      <div class="form-group row">
      <img src="/storage/profile_image/<?php echo e($volunteer->profile_image); ?>" alt="Forest" style="width:150px;height:150px;" class="profile-img">
      </div>
      <div class="first-info">
                     <table style="float:left">
                            <tr>
                              <th>Full Name</th>
                              <td><?php echo e($volunteer->name); ?></td>
                            <tr>
                            <tr>
                              <th>NRIC</th>
                              <td><?php echo e($volunteer->nric); ?></td>
                            <tr>
                            <tr>
                              <th>Gender</th>
                              <td><?php echo e($volunteer->gender); ?></td>
                            <tr>
                            <tr>
                              <th>Nationality</th>
                              <td><?php echo e($volunteer->nationality); ?></td>
                            <tr>
                            <tr>
                              <th>Race</th>
                              <td><?php echo e($volunteer->race); ?></td>
                            <tr>
                     </table>

                     <table  style="float:right">
                            <tr>
                              <th>Emergency Contact Name</th>
                              <td><?php echo e($volunteer->em_person); ?></td>
                            <tr>
                            <tr>
                              <th>Relationship</th>
                              <td><?php echo e($volunteer->em_relation); ?></td>
                            <tr>
                            <tr>
                              <th>Emergency Contact Number</th>
                              <td><?php echo e($volunteer->em_contact_no); ?></td>
                            <tr>
                            
                     </table>
                     </div>
<div class="second-info">
        <table style="float:left">
                            <tr>
                              <th>Email</th>
                              <td><?php echo e($volunteer->email); ?></td>
                            <tr>
                            <tr>
                              <th>Contact</th>
                              <td><?php echo e($volunteer->contact_no); ?></td>
                            <tr>
                            <tr>
                              <th>Address</th>
                              <td><?php echo e($volunteer->address); ?></td>
                            <tr>
                     </table>                     
</div>

<div class="third-info">
<table style="float:left">
                            <tr>
                              <th>Education level</th>
                              <?php $__currentLoopData = Common::$educationLvl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($index == $volunteer->education_level ): ?>
                                <td><?php echo e($name); ?></td>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              
                            <tr>
                            <tr>
                              <th>Occupation</th>
                              <td><?php echo e($volunteer->occupation); ?></td>
                            <tr>     
                            <tr>
                        <th>Area of contribution</th>
                            <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $names): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php $__currentLoopData = Common::$ContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $cat_names): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($names == $category): ?>
                                  <?php if($skillsetslist->$names == 1): ?>
                                    <td><?php echo e($cat_names); ?></td>
                                  <?php endif; ?>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                            
                            
                      <?php $__currentLoopData = Common::$SkillsetsShortform; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $names): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = Common::$SubContributeArea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $cat_names): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $__currentLoopData = $cat_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat => $subcat_names): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($names == $subcat): ?>
                              <?php if($skillsetslist->$names == 1): ?>
                              
                                <td><?php echo e($subcat_names); ?></td>
                               
                              <?php endif; ?>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                      <tr>  
                     </table>

</div>
                     

                     

                     

                     <div class="col-sm-12" style="margin-bottom:-6px;">
            <table class='table table-striped table-bordered text-center'>
              <col width="20%">
              <col width="16%">
              <col width="16%">
              <col width="16%">
              <col width="16%">
              <col width="16%">
              <thead class='thead-dark text-center'>
                <tr>
                  <th>
                    <label>Language</label>
                  </th>
                  <?php $__currentLoopData = Common::$Strength; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <th>
                    <label><?php echo e($value); ?></label>
                  </th>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
              </thead>
              <tbody class='thead-dark'>
              <?php $__currentLoopData = Common::$Language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill_key => $skill_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <th scope='row'>
                  <label><?php echo e($skill_value); ?></label>
                </th>
                <?php $__currentLoopData = $skillset; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s_key => $s_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($skill_key == $s_key): ?>
                <?php $__currentLoopData = Common::$Strength; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td onclick='set(this)'>
                  <?php if($key==$s_value): ?>
                  <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" checked disabled/>
                  <?php else: ?>
                  <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" disabled/>
                  <?php endif; ?>
                </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>

          <!-- Skills -->
          <div class="col-sm-12" style="margin-top:-20px;">
            <table class='table table-striped table-bordered text-center'>
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <?php $__currentLoopData = Common::$Skillsets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill_category_key => $skill_category_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <thead class='thead-dark'>
                <tr>
                  <th>
                    <label><?php echo e($skill_category_key); ?></label>
                  </th>
                  <?php $__currentLoopData = Common::$Proficient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <th>
                    <label><?php echo e($value); ?></label>
                  </th>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
              </thead>
              <tbody class='thead-dark'>
              <?php $__currentLoopData = $skill_category_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill_key => $skill_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $skillset; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s_key => $s_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($skill_key == $s_key): ?>
              <tr>
                <th scope='row'>
                  <label class="text-left col-sm-9"><?php echo e($skill_value); ?></label>
                </th>
                <?php $__currentLoopData = Common::$Proficient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td onclick='set(this)'>
                  <?php if($key== $s_value): ?>
                  <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" checked disabled />
                  <?php else: ?>
                  <input type='radio' name="<?php echo e($skill_key); ?>" value="<?php echo e($key); ?>" disabled/>
                  <?php endif; ?>
                </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tr>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
          </div>
                     </div>
                     <?php if(Session::get('authority')=='volunteer'): ?>
                     <button class='btn btn-block btn-primary' style="margin-bottom:20px;">
                      <a href='<?php echo e(route("volunteer.edit", $volunteer->vid)); ?>'>Edit Profile</a>
                    </button>
                    <button class='btn btn-block btn-primary' style="margin-bottom:20px;">
                      <a href='<?php echo e(route("volunteer.password", $volunteer->vid)); ?>'>Change Password</a>
                    </button>
                    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', ['title'=>'My Profile'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>